/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require("./bootstrap");
require("jquery");
window.axios = require("axios");
window.Vue = require("vue");

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

/* Vue.component("material-types", require("./components/MaterialTypes.vue"));

var appViewModel = new Vue({
  el: "#app"
}); */

$(function() {
  $('[data-toggle="tooltip"]').tooltip();
});

$(document).ready(function() {
  var dropZone = $("#course-file-dropzone");
  var maxFileSize = 30000000;

  if (typeof window.FileReader == "undefined") {
    dropZone.text("Не поддерживается браузером!");
    dropZone.addClass("dropzone__error");
  }

  dropZone[0].ondragover = function() {
    dropZone.addClass("dropzone__hover");
    return false;
  };
  dropZone[0].ondragleave = function() {
    dropZone.removeClass("dropzone__hover");
    return false;
  };
  dropZone[0].ondrop = function(event) {
    event.preventDefault();
    dropZone.removeClass("dropzone__hover");
    dropZone.addClass("dropzone__drop");

    dropZone.html('<div class="d-flex align-items-center justify-content-center"><div class="dropzone__progress-bar"><div class="dropzone__progress-bar-color" id="progress_color"></div></div></div>');

    var file = event.dataTransfer.files[0];
    if (file.size > maxFileSize) {
      dropZone.text("Файл слишком большой!");
      dropZone.addClass("dropzone__error");
      return false;
    }

    var formData = new FormData();
    formData.append(
      "course_id",
      document.head.querySelector('meta[name="csrf-token"]').content
    );
    formData.append("course_id", $("#course_id").val());
    formData.append("course_file", file);

    var uploadConfig = {
      onUploadProgress: progressEvent => {
        var percentCompleted = Math.floor(
          (progressEvent.loaded * 100) / progressEvent.total
        );
        $('#progress_color').css('width', percentCompleted);
      }
    };

    axios
      .post("/course-file/upload", formData, uploadConfig)
      .then(function(response) {
        dropZone.html(
          '<i class="fa fa-check mr-2"></i> Загрузка успешно завершена!'
        );
        location.reload();
      })
      .catch(function(error) {
        dropZone.html('<i class="fa fa-close mr-2"></i> Произошла ошибка!');
        if (dropZone.hasClass("dropzone__drop")) {
          dropZone.removeClass("dropzone__drop");
        }
        dropZone.addClass("dropzone__error");
      });
  };

  deleteFileButtons = $(".js-delete-file-btn");
  deleteFileButtons.on("click", function() {
    var buttonId = $(this).attr("id");
    var fileId = parseInt(
      buttonId.split("-")[buttonId.split("-").length - 1],
      10
    );

    var formData = new FormData();
    formData.append(
      "course_id",
      document.head.querySelector('meta[name="csrf-token"]').content
    );

    axios
      .post("/course-file/" + fileId + "/delete", formData)
      .then(function(response) {
        $("#file-" + fileId).remove();
        alert("Файл удален!");
      })
      .catch(function(error) {
        alert("Упс! Что явно пошло не так");
      });
  });
});
