// JS or Jquery

function customFormatDate(date) {
  var d = new Date(date),
    month = "" + (d.getMonth() + 1),
    day = "" + d.getDate(),
    year = d.getFullYear();

  if (month.length < 2) month = "0" + month;
  if (day.length < 2) day = "0" + day;

  return [day, month, year].join("/");
}

function customFormatDateForVal(date) {
  // param data must follow this format "dd/mm/yyyy"

  // custom format for input
  var tgl_arr = date.split("/");
  var tgl_lahir = `${tgl_arr[2]}-${tgl_arr[1]}-${tgl_arr[0]}`;

  return tgl_lahir;
}

/* -------------------------------------------------------------------------- */
/*                              All Dinamic Forms                             */
/* -------------------------------------------------------------------------- */

/* ------------------------- Dinamic Form Kronologi ------------------------- */
// Create Section
$(document).on("click", "#btn_add_kronologi_form", function () {
  console.log("click kronologi form");

  // console.log("form", dinamicFormId);
  // get dinamic group
  var dinamicFormGroupId = $(this).data("dinamic-group");

  // get id last form
  var lastForm = $(dinamicFormGroupId)
    .children(".kronologi_form")
    .last()
    .attr("id");
  // console.log('last', lastForm);
  // get last count form
  var lastChar = 0;
  if (lastForm !== undefined) {
    // lastChar = lastForm.slice(-1);
    lastChar = lastForm.split("_").pop();
  }
  // console.log(lastChar);

  // set next count form
  var nextCount = parseInt(lastChar) + 1;
  // console.log(nextCount);

  // clone dinamic form with iteration
  // $(dinamicFormId).clone().appendTo(dinamicFormGroupId).attr('id', 'kronologi_form_' +
  //     nextCount).addClass('kronologi_form');
  $("#template_kronologi_form")
    .clone()
    .appendTo(dinamicFormGroupId)
    .attr("id", "kronologi_form_" + nextCount)
    .addClass("kronologi_form")
    .removeAttr("style");

  // prev count
  var prevCount = nextCount - 1;

  // set button prev element form
  $("#kronologi_form_" + prevCount)
    .find("button.btn-tambah")
    .css("display", "none");
  $("#kronologi_form_" + prevCount)
    .find("button.btn-hapus")
    .css("display", "inline-block");

  // set button element
  $("#kronologi_form_" + nextCount)
    .find("button.btn-tambah")
    .css("display", "inline-block")
    .attr("data-dinamic-form", "#kronologi_form_" + nextCount);
  $("#kronologi_form_" + nextCount)
    .find("button.btn-hapus")
    .css("display", "inline-block")
    .attr("data-dinamic-form", "#kronologi_form_" + nextCount);

  // set datepicker to input tanggal kronologi
  $("#kronologi_form_" + nextCount)
    .find("input#input_tanggal_kronologi")
    .attr("id", "input_tanggal_kronologi_" + nextCount);
  // add datepicker
  $("#kronologi_form_" + nextCount)
    .find("input#input_tanggal_kronologi_" + nextCount)
    .datepicker({
      uiLibrary: "bootstrap4",
      format: "dd/mm/yyyy",
      autoclose: true,
      // language: 'id',
    });

  // set timepicker to input waktu kronologi
  $("#kronologi_form_" + nextCount)
    .find("input#input_waktu_kronologi")
    .attr("id", "input_waktu_kronologi_" + nextCount);
  // add timepicker
  $("#kronologi_form_" + nextCount)
    .find("input#input_waktu_kronologi_" + nextCount)
    .timepicker({
      mode: "24hr",
      uiLibrary: "bootstrap4",
      // format: 'HH:mm',
      use24hours: true,
    });
});

// Remove Section
$(document).on("click", "#btn_remove_kronologi_form", function () {
  // get dinamic form
  var dinamicFormId = $(this).data("dinamic-form");
  // console.log(onlydinamicFormId);

  // // get prev form
  var prevForm = $(dinamicFormId).prev();
  // console.log(prevForm);}

  //   // check if this form has btn-tambah active
  // console.log($(dinamicFormId).find('button.btn-tambah').css('display'));
  if (
    $(dinamicFormId).find("button.btn-tambah").css("display") == "inline-block"
  ) {
    // set prev form add button is active
    $(prevForm).find("button.btn-tambah").css("display", "inline-block");
  }

  var countDinamicForm = $(".kronologi_form").length;
  console.log(countDinamicForm);

  // set element btn-hapus to display none
  if (countDinamicForm == 3) {
    // 2 berarti akan memiliki satu elemen jadi lakukan sekarang
    $("#kronologi_group")
      .children(".kronologi_form")
      .find("button.btn-hapus")
      .css("display", "none");
  }

  // remove element form
  $(`${dinamicFormId}`).remove();
});
/* ------------------------- End Dinamic Form Kronologi ------------------------- */

/* --------------------------- Dinamic Form Pelaku -------------------------- */
// Create Section
$(document).on("click", "#btn_add_pelaku_form", function () {
  console.log("click pelaku form");

  // console.log("form", dinamicFormId);
  // get dinamic group
  var dinamicFormGroupId = $(this).data("dinamic-group");

  // get id last form
  var lastForm = $(dinamicFormGroupId)
    .children(".pelaku_form")
    .last()
    .attr("id");
  // console.log('last', lastForm);
  // get last count form
  var lastChar = 0;
  if (lastForm !== undefined) {
    // lastChar = lastForm.slice(-1);
    lastChar = lastForm.split("_").pop();
  }
  // console.log(lastChar);

  // set next count form
  var nextCount = parseInt(lastChar) + 1;
  // console.log(nextCount);

  // clone dinamic form with iteration
  // $(dinamicFormId).clone().appendTo(dinamicFormGroupId).attr('id', 'pelaku_form_' +
  //     nextCount).addClass('pelaku_form');
  $("#template_pelaku_form")
    .clone()
    .appendTo(dinamicFormGroupId)
    .attr("id", "pelaku_form_" + nextCount)
    .addClass("pelaku_form")
    .removeAttr("style");

  // prev count
  var prevCount = nextCount - 1;

  // set button prev element form
  $("#pelaku_form_" + prevCount)
    .find("button.btn-tambah")
    .css("display", "none");
  $("#pelaku_form_" + prevCount)
    .find("button.btn-hapus")
    .css("display", "inline-block");

  // set button element
  $("#pelaku_form_" + nextCount)
    .find("button.btn-tambah")
    .css("display", "inline-block")
    .attr("data-dinamic-form", "#pelaku_form_" + nextCount);
  $("#pelaku_form_" + nextCount)
    .find("button.btn-hapus")
    .css("display", "inline-block")
    .attr("data-dinamic-form", "#pelaku_form_" + nextCount);

  // set select 2 to input nama saksi
  $("#pelaku_form_" + nextCount)
    .find("select#input_nama_pelaku")
    .attr("id", "input_nama_pelaku_" + nextCount);
  // add select2
  $("#pelaku_form_" + nextCount)
    .find("select#input_nama_pelaku_" + nextCount)
    .select2({
      theme: "bootstrap4",
      allowClear: true,
    });

  //  // set select 2 to input perusahaan
  $("#pelaku_form_" + nextCount)
    .find("select#input_perusahaan_pelaku")
    .attr("id", "input_perusahaan_pelaku_" + nextCount);
  // add select2
  $("#pelaku_form_" + nextCount)
    .find("select#input_perusahaan_pelaku_" + nextCount)
    .select2({
      theme: "bootstrap4",
      allowClear: true,
    });
});

// Remove Section
$(document).on("click", "#btn_remove_pelaku_form", function () {
  // get dinamic form
  var dinamicFormId = $(this).data("dinamic-form");
  // console.log(onlydinamicFormId);

  // // get prev form
  var prevForm = $(dinamicFormId).prev();
  // console.log(prevForm);}

  //   // check if this form has btn-tambah active
  // console.log($(dinamicFormId).find('button.btn-tambah').css('display'));
  if (
    $(dinamicFormId).find("button.btn-tambah").css("display") == "inline-block"
  ) {
    // set prev form add button is active
    $(prevForm).find("button.btn-tambah").css("display", "inline-block");
  }

  var countDinamicForm = $(".pelaku_form").length;
  console.log(countDinamicForm);

  // set element btn-hapus to display none
  if (countDinamicForm == 3) {
    // 2 berarti akan memiliki satu elemen jadi lakukan sekarang
    $("#pelaku_group")
      .children(".pelaku_form")
      .find("button.btn-hapus")
      .css("display", "none");
  }

  // remove element form
  $(`${dinamicFormId}`).remove();
});
/* --------------------------- End Dinamic Form Pelaku -------------------------- */

/* ------------------------------ Dinamic Form Saksi ------------------------------ */
// Create Section
$(document).on("click", "#btn_add_dinamic_form", function () {
  console.log("click dinamic form");

  // get dinamic form
  var dinamicFormId = $(this).data("dinamic-form");
  // console.log("form", dinamicFormId);
  // get dinamic group
  var dinamicFormGroupId = $(this).data("dinamic-group");

  // var onlydinamicFormId = dinamicFormId.substr(dinamicFormId.indexOf("#") + 1);

  // get count form
  var countDinamicForm = $(".dinamic_identitas_form").length;
  // get id last form
  var lastForm = $(dinamicFormGroupId)
    .children(".dinamic_identitas_form")
    .last()
    .attr("id");
  // console.log('last', lastForm);
  // get last count form
  var lastChar = 0;
  if (lastForm !== undefined) {
    // lastChar = lastForm.slice(-1);
    lastChar = lastForm.split("_").pop();
  }
  // console.log(lastChar);

  // set next count form
  var nextCount = parseInt(lastChar) + 1;
  // console.log(nextCount);

  // clone dinamic form with iteration
  // $(dinamicFormId).clone().appendTo(dinamicFormGroupId).attr('id', 'dinamic_identitas_form_' +
  //     nextCount).addClass('dinamic_identitas_form');
  $("#template_dinamic_identitas_form")
    .clone()
    .appendTo(dinamicFormGroupId)
    .attr("id", "dinamic_identitas_form_" + nextCount)
    .addClass("dinamic_identitas_form")
    .removeAttr("style");

  // prev count
  var prevCount = nextCount - 1;

  var prevForm = $(dinamicFormId).prev();
  // set button prev element form
  $("#dinamic_identitas_form_" + prevCount)
    .find("button.btn-tambah")
    .css("display", "none");
  $("#dinamic_identitas_form_" + prevCount)
    .find("button.btn-hapus")
    .css("display", "inline-block");

  // set button element
  $("#dinamic_identitas_form_" + nextCount)
    .find("button.btn-tambah")
    .css("display", "inline-block")
    .attr("data-dinamic-form", "#dinamic_identitas_form_" + nextCount);
  $("#dinamic_identitas_form_" + nextCount)
    .find("button.btn-hapus")
    .css("display", "inline-block")
    .attr("data-dinamic-form", "#dinamic_identitas_form_" + nextCount);

  // set select 2 to input nama saksi
  $("#dinamic_identitas_form_" + nextCount)
    .find("select#input_nama_saksi")
    .attr("id", "input_nama_saksi_" + nextCount);
  // add select2
  $("#dinamic_identitas_form_" + nextCount)
    .find("select#input_nama_saksi_" + nextCount)
    .select2({
      theme: "bootstrap4",
      allowClear: true,
    });

  //  // set select 2 to input perusahaan
  $("#dinamic_identitas_form_" + nextCount)
    .find("select#input_perusahaan")
    .attr("id", "input_perusahaan_" + nextCount);
  // add select2
  $("#dinamic_identitas_form_" + nextCount)
    .find("select#input_perusahaan_" + nextCount)
    .select2({
      theme: "bootstrap4",
      allowClear: true,
    });

  // set select 2 to input pekerjaan
  $("#dinamic_identitas_form_" + nextCount)
    .find("select#input_pekerjaan")
    .attr("id", "input_pekerjaan_" + nextCount);
  // add select2
  $("#dinamic_identitas_form_" + nextCount)
    .find("select#input_pekerjaan_" + nextCount)
    .select2({
      theme: "bootstrap4",
      allowClear: true,
    });
});

// Remove Section
$(document).on("click", "#btn_remove_dinamic_form", function () {
  // get dinamic form
  var dinamicFormId = $(this).data("dinamic-form");
  var onlydinamicFormId = dinamicFormId.substr(dinamicFormId.indexOf("#") + 1);
  // console.log(onlydinamicFormId);

  // // get prev form
  var prevForm = $(dinamicFormId).prev();
  // console.log(prevForm);}

  //   // check if this form has btn-tambah active
  // console.log($(dinamicFormId).find('button.btn-tambah').css('display'));
  if (
    $(dinamicFormId).find("button.btn-tambah").css("display") == "inline-block"
  ) {
    // set prev form add button is active
    $(prevForm).find("button.btn-tambah").css("display", "inline-block");
  }

  var countDinamicForm = $(".dinamic_identitas_form").length;
  console.log(countDinamicForm);

  // set element btn-hapus to display none
  if (countDinamicForm == 3) {
    // 2 berarti akan memiliki satu elemen jadi lakukan sekarang
    $("#dinamic_identitas_group")
      .children(".dinamic_identitas_form")
      .find("button.btn-hapus")
      .css("display", "none");
  }

  // remove element form
  $(`${dinamicFormId}`).remove();
});
/* ---------------------------- End Dinamic Form Saksi ---------------------------- */

/* ----------------------- Dinamic Form Dampak Manusia ---------------------- */
var classIdFormManusia = "dynamic_dampak_manusia_form";
// Create Section
$(document).on("click", "#btn_add_dynamic_form_dampak_manusia", function () {
  console.log("click dinamic form");

  // get dinamic group
  var dinamicFormGroupId = $("#dynamic_dampak_manusia_group");

  // var onlydinamicFormId = dinamicFormId.substr(dinamicFormId.indexOf("#") + 1);

  // get id last form
  var lastForm = $(dinamicFormGroupId)
    .children(`.${classIdFormManusia}`)
    .last()
    .attr("id");
  // console.log('last', lastForm);
  // get last count form
  var lastChar = 0;
  if (lastForm !== undefined) {
    // lastChar = lastForm.slice(-1);
    lastChar = lastForm.split("_").pop();
  }
  // console.log(lastChar);

  // set next count form
  var nextCount = parseInt(lastChar) + 1;
  // console.log(nextCount);

  // clone dinamic form with iteration
  $(`#template_${classIdFormManusia}`)
    .clone()
    .appendTo(dinamicFormGroupId)
    .attr("id", `${classIdFormManusia}_` + nextCount)
    .addClass(classIdFormManusia)
    .removeAttr("style");

  // prev count
  var prevCount = nextCount - 1;

  // set button prev element form
  $(`#${classIdFormManusia}_` + prevCount)
    .find("button.btn-tambah")
    .css("display", "none");
  $(`#${classIdFormManusia}_` + prevCount)
    .find("button.btn-hapus")
    .css("display", "inline-block");

  // set button element
  $(`#${classIdFormManusia}_` + nextCount)
    .find("button.btn-tambah")
    .css("display", "inline-block")
    .attr("data-dinamic-form", `#${classIdFormManusia}_` + nextCount);
  $(`#${classIdFormManusia}_` + nextCount)
    .find("button.btn-hapus")
    .css("display", "inline-block")
    .attr("data-dinamic-form", `#${classIdFormManusia}_` + nextCount);

  // set input injury
  $(`#${classIdFormManusia}_` + nextCount)
    .find("select.input-injury-manusia")
    .attr("data-dinamic-form", `#${classIdFormManusia}_` + nextCount);

  // set select 2 to input korban
  $(`#${classIdFormManusia}_` + nextCount)
    .find("select#input_nama_korban")
    .attr("id", "input_nama_korban_" + nextCount);
  // add select2
  $(`#${classIdFormManusia}_` + nextCount)
    .find("select#input_nama_korban_" + nextCount)
    .select2({
      theme: "bootstrap4",
      allowClear: true,
    });

  // set select 2 to input perusahaan
  $(`#${classIdFormManusia}_` + nextCount)
    .find("select#input_perusahaan")
    .attr("id", "input_perusahaan_" + nextCount);
  // add select2
  $(`#${classIdFormManusia}_` + nextCount)
    .find("select#input_perusahaan_" + nextCount)
    .select2({
      theme: "bootstrap4",
      allowClear: true,
    });

  // set select 2 to input injury
  $(`#${classIdFormManusia}_` + nextCount)
    .find("select#input_injury")
    .attr("id", "input_injury_" + nextCount);
  // add select2
  $(`#${classIdFormManusia}_` + nextCount)
    .find("select#input_injury_" + nextCount)
    .select2({
      theme: "bootstrap4",
      allowClear: true,
    });
});

// Remove Section
$(document).on("click", "#btn_remove_dynamic_form_dampak_manusia", function () {
  // get dinamic form
  var dinamicFormId = $(this).data("dinamic-form");
  var onlydinamicFormId = dinamicFormId.substr(dinamicFormId.indexOf("#") + 1);
  // console.log(onlydinamicFormId);

  // get prev form
  var prevForm = $(dinamicFormId).prev();
  // console.log(prevForm);}

  // check if this form has btn-tambah active
  if (
    $(dinamicFormId).find("button.btn-tambah").css("display") == "inline-block"
  ) {
    // set prev form add button is active
    $(prevForm).find("button.btn-tambah").css("display", "inline-block");
  }

  var countDinamicForm = $(`.${classIdFormManusia}`).length;
  // console.log(countDinamicForm);

  // set element btn-hapus to display none
  if (countDinamicForm == 3) {
    // 2 berarti akan memiliki satu elemen jadi lakukan sekarang
    $("#dynamic_dampak_manusia_group")
      .children(`.${classIdFormManusia}`)
      .find("button.btn-hapus")
      .css("display", "none");
  }

  // remove element form
  $(`${dinamicFormId}`).remove();
});
/* --------------------- End Dinamic Form Dampak Manusia -------------------- */

/* -------------------- Dinamic Form Dampak Suprastruktur ------------------- */
var classIdFormSuprastruktur = "dynamic_dampak_suprastruktur_form";
// Create Section
$(document).on(
  "click",
  "#btn_add_dynamic_form_dampak_suprastruktur",
  function () {
    console.log("click dinamic form");

    // get dinamic group
    var dinamicFormGroupId = $("#dynamic_dampak_suprastruktur_group");

    // var onlydinamicFormId = dinamicFormId.substr(dinamicFormId.indexOf("#") + 1);

    // get id last form
    var lastForm = $(dinamicFormGroupId)
      .children(`.${classIdFormSuprastruktur}`)
      .last()
      .attr("id");
    // console.log('last', lastForm);
    // get last count form
    var lastChar = 0;
    if (lastForm !== undefined) {
      // lastChar = lastForm.slice(-1);
      lastChar = lastForm.split("_").pop();
    }
    // console.log(lastChar);

    // set next count form
    var nextCount = parseInt(lastChar) + 1;
    // console.log(nextCount);

    // clone dinamic form with iteration
    $(`#template_${classIdFormSuprastruktur}`)
      .clone()
      .appendTo(dinamicFormGroupId)
      .attr("id", `${classIdFormSuprastruktur}_` + nextCount)
      .addClass(classIdFormSuprastruktur)
      .removeAttr("style");

    // prev count
    var prevCount = nextCount - 1;

    // set button prev element form
    $(`#${classIdFormSuprastruktur}_` + prevCount)
      .find("button.btn-tambah")
      .css("display", "none");
    $(`#${classIdFormSuprastruktur}_` + prevCount)
      .find("button.btn-hapus")
      .css("display", "inline-block");

    // set button element
    $(`#${classIdFormSuprastruktur}_` + nextCount)
      .find("button.btn-tambah")
      .css("display", "inline-block")
      .attr("data-dinamic-form", `#${classIdFormSuprastruktur}_` + nextCount);
    $(`#${classIdFormSuprastruktur}_` + nextCount)
      .find("button.btn-hapus")
      .css("display", "inline-block")
      .attr("data-dinamic-form", `#${classIdFormSuprastruktur}_` + nextCount);

    // set select 2 to input suprastruktur
    $(`#${classIdFormSuprastruktur}_` + nextCount)
      .find("select#input_suprastruktur")
      .attr("id", "input_suprastruktur_" + nextCount);
    // add select2
    $(`#${classIdFormSuprastruktur}_` + nextCount)
      .find("select#input_suprastruktur_" + nextCount)
      .select2({
        theme: "bootstrap4",
        allowClear: true,
      });

    // set select 2 to input perusahaan
    // $(`#${classIdFormSuprastruktur}_` + nextCount)
    //   .find("select#input_perusahaan")
    //   .attr("id", "input_perusahaan_" + nextCount);
    // // add select2
    // $(`#${classIdFormSuprastruktur}_` + nextCount)
    //   .find("select#input_perusahaan_" + nextCount)
    //   .select2({
    //     theme: "bootstrap4",
    //  allowClear: true,
    //   });

    // set select 2 to input injury
    $(`#${classIdFormSuprastruktur}_` + nextCount)
      .find("select#input_injury_suprastruktur")
      .attr("id", "input_injury_suprastruktur_" + nextCount);
    // add select2
    $(`#${classIdFormSuprastruktur}_` + nextCount)
      .find("select#input_injury_suprastruktur_" + nextCount)
      .select2({
        theme: "bootstrap4",
        allowClear: true,
      });
  }
);

// Remove Section
$(document).on(
  "click",
  "#btn_remove_dynamic_form_dampak_suprastruktur",
  function () {
    // get dinamic form
    var dinamicFormId = $(this).data("dinamic-form");
    var onlydinamicFormId = dinamicFormId.substr(
      dinamicFormId.indexOf("#") + 1
    );
    // console.log(onlydinamicFormId);

    // get prev form
    var prevForm = $(dinamicFormId).prev();
    // console.log(prevForm);}

    // check if this form has btn-tambah active
    if (
      $(dinamicFormId).find("button.btn-tambah").css("display") ==
      "inline-block"
    ) {
      // set prev form add button is active
      $(prevForm).find("button.btn-tambah").css("display", "inline-block");
    }

    var countDinamicForm = $(`.${classIdFormSuprastruktur}`).length;
    // console.log(countDinamicForm);

    // set element btn-hapus to display none
    if (countDinamicForm == 3) {
      // 2 berarti akan memiliki satu elemen jadi lakukan sekarang
      $("#dynamic_dampak_suprastruktur_group")
        .children(`.${classIdFormSuprastruktur}`)
        .find("button.btn-hapus")
        .css("display", "none");
    }

    // remove element form
    $(`${dinamicFormId}`).remove();
  }
);
/* ------------------ End Dinamic Form Dampak Suprastruktur ----------------- */

/* -------------------- Dinamic Form Dampak Infrastruktur ------------------- */
var classIdFormInfrastruktur = "dynamic_dampak_infrastruktur_form";
// Create Section
$(document).on(
  "click",
  "#btn_add_dynamic_form_dampak_infrastruktur",
  function () {
    console.log("click dinamic form");

    // get dinamic group
    var dinamicFormGroupId = $("#dynamic_dampak_infrastruktur_group");

    // var onlydinamicFormId = dinamicFormId.substr(dinamicFormId.indexOf("#") + 1);

    // get id last form
    var lastForm = $(dinamicFormGroupId)
      .children(`.${classIdFormInfrastruktur}`)
      .last()
      .attr("id");
    // console.log('last', lastForm);
    // get last count form
    var lastChar = 0;
    if (lastForm !== undefined) {
      // lastChar = lastForm.slice(-1);
      lastChar = lastForm.split("_").pop();
    }
    // console.log(lastChar);

    // set next count form
    var nextCount = parseInt(lastChar) + 1;
    // console.log(nextCount);

    // clone dinamic form with iteration
    $(`#template_${classIdFormInfrastruktur}`)
      .clone()
      .appendTo(dinamicFormGroupId)
      .attr("id", `${classIdFormInfrastruktur}_` + nextCount)
      .addClass(classIdFormInfrastruktur)
      .removeAttr("style");

    // prev count
    var prevCount = nextCount - 1;

    // set button prev element form
    $(`#${classIdFormInfrastruktur}_` + prevCount)
      .find("button.btn-tambah")
      .css("display", "none");
    $(`#${classIdFormInfrastruktur}_` + prevCount)
      .find("button.btn-hapus")
      .css("display", "inline-block");

    // set button element
    $(`#${classIdFormInfrastruktur}_` + nextCount)
      .find("button.btn-tambah")
      .css("display", "inline-block")
      .attr("data-dinamic-form", `#${classIdFormInfrastruktur}_` + nextCount);
    $(`#${classIdFormInfrastruktur}_` + nextCount)
      .find("button.btn-hapus")
      .css("display", "inline-block")
      .attr("data-dinamic-form", `#${classIdFormInfrastruktur}_` + nextCount);

    // set select 2 to input infrastruktur
    $(`#${classIdFormInfrastruktur}_` + nextCount)
      .find("select#input_infrastruktur")
      .attr("id", "input_infrastruktur_" + nextCount);
    // add select2
    $(`#${classIdFormInfrastruktur}_` + nextCount)
      .find("select#input_infrastruktur_" + nextCount)
      .select2({
        theme: "bootstrap4",
        allowClear: true,
      });

    // set select 2 to input perusahaan
    // $(`#${classIdFormInfrastruktur}_` + nextCount)
    //   .find("select#input_perusahaan_infrastruktur")
    //   .attr("id", "input_perusahaan_infrastruktur_" + nextCount);
    // // add select2
    // $(`#${classIdFormInfrastruktur}_` + nextCount)
    //   .find("select#input_perusahaan_infrastruktur_" + nextCount)
    //   .select2({
    //     theme: "bootstrap4",
    //  allowClear: true,
    //   });

    // set select 2 to input kriteria dampak
    $(`#${classIdFormInfrastruktur}_` + nextCount)
      .find("select#input_kriteria_dampak")
      .attr("id", "input_kriteria_dampak_" + nextCount);
    // add select2
    $(`#${classIdFormInfrastruktur}_` + nextCount)
      .find("select#input_kriteria_dampak_" + nextCount)
      .select2({
        theme: "bootstrap4",
        allowClear: true,
      });
  }
);

// Remove Section
$(document).on(
  "click",
  "#btn_remove_dynamic_form_dampak_infrastruktur",
  function () {
    // get dinamic form
    var dinamicFormId = $(this).data("dinamic-form");
    var onlydinamicFormId = dinamicFormId.substr(
      dinamicFormId.indexOf("#") + 1
    );
    // console.log(onlydinamicFormId);

    // get prev form
    var prevForm = $(dinamicFormId).prev();
    // console.log(prevForm);}

    // check if this form has btn-tambah active
    if (
      $(dinamicFormId).find("button.btn-tambah").css("display") ==
      "inline-block"
    ) {
      // set prev form add button is active
      $(prevForm).find("button.btn-tambah").css("display", "inline-block");
    }

    var countDinamicForm = $(`.${classIdFormInfrastruktur}`).length;
    // console.log(countDinamicForm);

    // set element btn-hapus to display none
    if (countDinamicForm == 3) {
      // 2 berarti akan memiliki satu elemen jadi lakukan sekarang
      $("#dynamic_dampak_infrastruktur_group")
        .children(`.${classIdFormInfrastruktur}`)
        .find("button.btn-hapus")
        .css("display", "none");
    }

    // remove element form
    $(`${dinamicFormId}`).remove();
  }
);
/* ------------------ End Dinamic Form Dampak Infrastruktur ----------------- */

/* --------------------- Dinamic Form Dampak Lingkungan --------------------- */
var classIdFormLingkungan = "dynamic_dampak_lingkungan_form";
// Create Section
$(document).on("click", "#btn_add_dynamic_form_dampak_lingkungan", function () {
  console.log("click dinamic form");

  // get dinamic form
  // var dinamicFormId = $(this).data('dinamic-form');
  // get dinamic group
  var dinamicFormGroupId = $("#dynamic_dampak_lingkungan_group");

  // var onlydinamicFormId = dinamicFormId.substr(dinamicFormId.indexOf("#") + 1);

  // get id last form
  var lastForm = $(dinamicFormGroupId)
    .children(`.${classIdFormLingkungan}`)
    .last()
    .attr("id");
  // console.log('last', lastForm);
  // get last count form
  var lastChar = 0;
  if (lastForm !== undefined) {
    // lastChar = lastForm.slice(-1);
    lastChar = lastForm.split("_").pop();
  }
  // console.log(lastChar);

  // set next count form
  var nextCount = parseInt(lastChar) + 1;
  // console.log(nextCount);

  // clone dinamic form with iteration
  $(`#template_${classIdFormLingkungan}`)
    .clone()
    .appendTo(dinamicFormGroupId)
    .attr("id", `${classIdFormLingkungan}_` + nextCount)
    .addClass(classIdFormLingkungan)
    .removeAttr("style");

  // prev count
  var prevCount = nextCount - 1;

  // set button prev element form
  $(`#${classIdFormLingkungan}_` + prevCount)
    .find("button.btn-tambah")
    .css("display", "none");
  $(`#${classIdFormLingkungan}_` + prevCount)
    .find("button.btn-hapus")
    .css("display", "inline-block");

  // set button element
  $(`#${classIdFormLingkungan}_` + nextCount)
    .find("button.btn-tambah")
    .css("display", "inline-block")
    .attr("data-dinamic-form", `#${classIdFormLingkungan}_` + nextCount);
  $(`#${classIdFormLingkungan}_` + nextCount)
    .find("button.btn-hapus")
    .css("display", "inline-block")
    .attr("data-dinamic-form", `#${classIdFormLingkungan}_` + nextCount);

  // set select 2 to input kriteria dampak
  $(`#${classIdFormLingkungan}_` + nextCount)
    .find("select#input_kriteria_dampak_lingkungan")
    .attr("id", "input_kriteria_dampak_lingkungan_" + nextCount);
  // add select2
  $(`#${classIdFormLingkungan}_` + nextCount)
    .find("select#input_kriteria_dampak_lingkungan_" + nextCount)
    .select2({
      theme: "bootstrap4",
      allowClear: true,
    });
});

// Remove Section
$(document).on(
  "click",
  "#btn_remove_dynamic_form_dampak_lingkungan",
  function () {
    // get dinamic form
    var dinamicFormId = $(this).data("dinamic-form");
    var onlydinamicFormId = dinamicFormId.substr(
      dinamicFormId.indexOf("#") + 1
    );
    // console.log(onlydinamicFormId);

    // get prev form
    var prevForm = $(dinamicFormId).prev();
    // console.log(prevForm);}

    // check if this form has btn-tambah active
    if (
      $(dinamicFormId).find("button.btn-tambah").css("display") ==
      "inline-block"
    ) {
      // set prev form add button is active
      $(prevForm).find("button.btn-tambah").css("display", "inline-block");
    }

    var countDinamicForm = $(`.${classIdFormLingkungan}`).length;
    // console.log(countDinamicForm);

    // set element btn-hapus to display none
    if (countDinamicForm == 3) {
      // 2 berarti akan memiliki satu elemen jadi lakukan sekarang
      $("#dynamic_dampak_lingkungan_group")
        .children(`.${classIdFormLingkungan}`)
        .find("button.btn-hapus")
        .css("display", "none");
    }

    // remove element form
    $(`${dinamicFormId}`).remove();
  }
);
/* ------------------- End Dinamic Form Dampak Lingkungan ------------------- */

/* ----------------------- Dinamic Form Tindak Lanjut ----------------------- */
var classIdFormTindakLanjut = "dynamic_tindak_lanjut_form";
// Create Section
$(document).on("click", "#btn_add_dynamic_form_tindak_lanjut", function () {
  console.log("click dinamic form");

  // get dinamic form
  // var dinamicFormId = $(this).data('dinamic-form');
  // get dinamic group
  var dinamicFormGroupId = $("#dynamic_tindak_lanjut_group");

  // var onlydinamicFormId = dinamicFormId.substr(dinamicFormId.indexOf("#") + 1);

  // get id last form
  var lastForm = $(dinamicFormGroupId)
    .children(`.${classIdFormTindakLanjut}`)
    .last()
    .attr("id");
  // console.log('last', lastForm);
  // get last count form
  var lastChar = 0;
  if (lastForm !== undefined) {
    // lastChar = lastForm.slice(-1);
    lastChar = lastForm.split("_").pop();
  }
  // console.log(lastChar);

  // set next count form
  var nextCount = parseInt(lastChar) + 1;
  // console.log(nextCount);

  // clone dinamic form with iteration
  $(`#template_${classIdFormTindakLanjut}`)
    .clone()
    .appendTo(dinamicFormGroupId)
    .attr("id", `${classIdFormTindakLanjut}_` + nextCount)
    .addClass(classIdFormTindakLanjut)
    .removeAttr("style");

  // prev count
  var prevCount = nextCount - 1;

  // set button prev element form
  $(`#${classIdFormTindakLanjut}_` + prevCount)
    .find("button.btn-tambah")
    .css("display", "none");
  $(`#${classIdFormTindakLanjut}_` + prevCount)
    .find("button.btn-hapus")
    .css("display", "inline-block");

  // set button element
  $(`#${classIdFormTindakLanjut}_` + nextCount)
    .find("button.btn-tambah")
    .css("display", "inline-block")
    .attr("data-dinamic-form", `#${classIdFormTindakLanjut}_` + nextCount);
  $(`#${classIdFormTindakLanjut}_` + nextCount)
    .find("button.btn-hapus")
    .css("display", "inline-block")
    .attr("data-dinamic-form", `#${classIdFormTindakLanjut}_` + nextCount);

  // set select 2 to input kategori tindak lanjut
  $(`#${classIdFormTindakLanjut}_` + nextCount)
    .find("select#input_kategori_tindak_lanjut")
    .attr("id", "input_kategori_tindak_lanjut_" + nextCount);
  // add select2
  $(`#${classIdFormTindakLanjut}_` + nextCount)
    .find("select#input_kategori_tindak_lanjut_" + nextCount)
    .select2({
      theme: "bootstrap4",
      allowClear: true,
    });

  // set select 2 to input jabatan tindak lanjut
  $(`#${classIdFormTindakLanjut}_` + nextCount)
    .find("select#input_jabatan_tindak_lanjut")
    .attr("id", "input_jabatan_tindak_lanjut_" + nextCount);
  // add select2
  $(`#${classIdFormTindakLanjut}_` + nextCount)
    .find("select#input_jabatan_tindak_lanjut_" + nextCount)
    .select2({
      theme: "bootstrap4",
      allowClear: true,
    });

  // set datetime to input duedate tindak lanjut
  $(`#${classIdFormTindakLanjut}_` + nextCount)
    .find("input#input_single_date")
    .attr("id", "input_single_date_" + nextCount);
  // add datetime
  $(`#${classIdFormTindakLanjut}_` + nextCount)
    .find("input#input_single_date_" + nextCount)
    .datepicker({
      uiLibrary: "bootstrap4",
      format: "dd/mm/yyyy",
      autoclose: true,
      language: "id",
    });
});

// Create Section
$(document).on("click", "#btn_remove_dynamic_form_tindak_lanjut", function () {
  // get dinamic form
  var dinamicFormId = $(this).data("dinamic-form");
  var onlydinamicFormId = dinamicFormId.substr(dinamicFormId.indexOf("#") + 1);
  // console.log(onlydinamicFormId);

  // get prev form
  var prevForm = $(dinamicFormId).prev();
  // console.log(prevForm);}

  // check if this form has btn-tambah active
  if (
    $(dinamicFormId).find("button.btn-tambah").css("display") == "inline-block"
  ) {
    // set prev form add button is active
    $(prevForm).find("button.btn-tambah").css("display", "inline-block");
  }

  var countDinamicForm = $(`.${classIdFormTindakLanjut}`).length;
  // console.log(countDinamicForm);

  // set element btn-hapus to display none
  if (countDinamicForm == 3) {
    // 2 berarti akan memiliki satu elemen jadi lakukan sekarang
    $("#dynamic_tindak_lanjut_group")
      .children(`.${classIdFormTindakLanjut}`)
      .find("button.btn-hapus")
      .css("display", "none");
  }

  // remove element form
  $(`${dinamicFormId}`).remove();
});
/* --------------------- End Dinamic Form Tindak Lanjut --------------------- */
