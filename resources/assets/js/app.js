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

Vue.component("material-types", require("./components/MaterialTypes.vue"));

var materialTypesViewModel = new Vue({
  el: "#materialTypes"
});

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

    var file = event.dataTransfer.files[0];

    if (file.size > maxFileSize) {
      dropZone.text("Файл слишком большой!");
      dropZone.addClass("dropzone__error");
      return false;
    }

    var formData = new FormData();
    formData.append("course_id", document.head.querySelector('meta[name="csrf-token"]').content);
    formData.append("course_id", $('#course_id').val());
    formData.append("course_file", file);

    axios
      .post("/course-file/upload", formData)
      .then(function(response) {
        dropZone.text('Загрузка успешно завершена!');
      })
      .catch(function(error) {
        dropZone.text('Произошла ошибка!');
        dropZone.addClass('dropzone__error');
      });
  };
});
