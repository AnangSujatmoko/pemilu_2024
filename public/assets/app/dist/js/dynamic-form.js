function addForm(){
   var addrow = '<div class="col-sm-12" >\
   <div class="form-group baru-data row">\
       <div class="col-md-2">\
       <select class="form-control select2 " data-placeholder="Nama Korban">\
       <option></option>\
       <option>NIP123 - Anton | SPMT</option>\
       <option>NIP456 - Budi | SPMT</option>\
       <option>NIP789 - Cahyono | PT ABC</option>\
       <option>NIP001 - Dewi Intan | PT XYZ</option>\
       <option>NIP002 - Fransisca | CV Anu</option>\
       <option>NIP003 - Gator Suseno | PT Sejahtera</option>\
       <option>NIP011 - Haryadi Eko, ST, M.Kom | PT Truck Gandeng</option>\
       <option>NIP005 - Iwan Cahaya | PT Berkah Sentosa Adidaya</option>\
       <option>NIP006 - Joko Lelono, ST | CV Nganu</option>\
       <option>NIP007 - Ketut Wangi | PT Mendoakan</option>\
     </select>\
       </div>\
       <div class="col-md-2">\
       <select class="form-control select2" name="pekerjaan" data-placeholder="Pekerjaan">\
       <option></option>\
       <option>Pekerjaan 1</option>\
       <option>Pekerjaan 2</option>\
       <option>Pekerjaan 3</option>\
       <option>Pekerjaan 4</option>\
       </select> </div>\<div class="col-md-1">\
       <select class="form-control select2" name="injury" data-placeholder="Injury">\
       <option value=""></option>\
         <option>First Aid Injury (FAI)</option>\
         <option>Medical Treatment Injury (MTI)</option>\
         <option>Resticted Work Injury (RWI)</option>\
         <option>Long Time Injury (LTI)</option>\
         <option>Fatality (FAT)</option>\
     </select>\
       </div>\
       <div class="col-md-3">\
       <textarea name="deskripsi" placeholder="Uraian" class="form-control" rows="2"></textarea>\
       </div>\
       <div class="button-group">\
           <button type="button" class="btn btn-success btn-tambah"><i class="fa fa-plus"></i></button>\
           <button type="button" class="btn btn-danger btn-hapus" style="display:none;"><i class="fa fa-times"></i></button>\
       </div>\
       </div>\
</div>'
   $("#dynamic_form").append(addrow);
}

$("#dynamic_form").on("click", ".btn-tambah", function(){
   addForm()
   $(this).css("display","none")     
   var valtes = $(this).parent().find(".btn-hapus").css("display","");
})

$("#dynamic_form").on("click", ".btn-hapus", function(){
 $(this).parent().parent('.baru-data').remove();
 var bykrow = $(".baru-data").length;
 if(bykrow==1){
   $(".btn-hapus").css("display","none")
   $(".btn-tambah").css("display","");
 }else{
   $('.baru-data').last().find('.btn-tambah').css("display","");
 }
});



$('.btn-simpan').on('click', function () {
   $('#dynamic_form').find('input[type="text"], input[type="number"], select, textarea').each(function() {
      if( $(this).val() == "" ) {
         event.preventDefault()
         $(this).css('border-color', 'red');
         
         $(this).on('focus', function() {
            $(this).css('border-color', '#ccc');
         });
      }
   })
})




function addForm2(){
   var addrow2 = '<div class="col-sm-12" >\
   <div class="form-group baru-data2 row">\
   <div class="col-md-2">\
   <select class="form-control select2 " data-placeholder="Identitas Suprastruktur"><option></option>\
   <option>Suprastruktur 1</option>\
   <option>Suprastruktur 2</option>\
   <option>Suprastruktur 3</option>\
   <option>Suprastruktur 4</option>\
   <option>Suprastruktur 5</option>\
   <option>Suprastruktur 6</option>\
   <option>Suprastruktur 7</option>\
   <option>Suprastruktur 8</option>\
   <option>Suprastruktur 9</option>\
   <option>Suprastruktur 10</option>\
 </select>\
</div>\
   <div class="col-md-2">\
   <select class="form-control select2 " data-placeholder="Nama Perusahaan">\
   <option></option>\
   <option>Perusahaan 1</option>\
   <option>Perusahaan 2</option>\
   <option>Perusahaan 3</option>\
   <option>Perusahaan 4</option>\
   <option>Perusahaan 5</option>\
   <option>Perusahaan 6</option>\
   <option>Perusahaan 7</option>\
   <option>Perusahaan 8</option>\
   <option>Perusahaan 9</option>\
   <option>Perusahaan 10</option>\
 </select>\
</div>\
             <div class="col-md-1">\
             <select class="form-control select2" name="injury" data-placeholder="Injury">\
             <option value=""></option>\
             <option>Ringan</option>\
             <option>Sedang</option>\
             <option>Berat</option>\
             <option>Fatality</option>\
           </select>\
         </div>\
         <div class="col-md-3">\
         <textarea name="deskripsi" placeholder="Deskripsi" class="form-control" rows="3"></textarea>\
     </div>\
     <div class="button-group">\
                 <button type="button" class="btn btn-success btn-tambah"><i class="fa fa-plus"></i></button>\
                 <button type="button" class="btn btn-danger btn-hapus"><i class="fa fa-times"></i></button>\
             </div>\
      </div>'
   $("#dynamic_form2").append(addrow2);
}

$("#dynamic_form2").on("click", ".btn-tambah", function(){
   addForm2()
   $(this).css("display","none")     
   var valtes = $(this).parent().find(".btn-hapus").css("display","");
})

$("#dynamic_form2").on("click", ".btn-hapus", function(){
 $(this).parent().parent('.baru-data2').remove();
 var bykrow2 = $(".baru-data2").length;
 if(bykrow2==1){
   $(".btn-hapus").css("display","none")
   $(".btn-tambah").css("display","");
 }else{
   $('.baru-data2').last().find('.btn-tambah').css("display","");
 }
});



$('.btn-simpan').on('click', function () {
   $('#dynamic_form2').find('input[type="text"], input[type="number"], select, textarea').each(function() {
      if( $(this).val() == "" ) {
         event.preventDefault()
         $(this).css('border-color', 'red');
         
         $(this).on('focus', function() {
            $(this).css('border-color', '#ccc');
         });
      }
   })
})



function addForm3(){
   var addrow3 = '<div class="col-sm-12" >\
   <div class="form-group baru-data3 row">\
   <div class="col-md-2">\
   <select class="form-control select2 " data-placeholder="Identitas Infrastruktur">\
   <option></option>\
   <option>Infrastruktur 1</option>\
   <option>Infrastruktur 2</option>\
   <option>Infrastruktur 3</option>\
   <option>Infrastruktur 4</option>\
   <option>Infrastruktur 5</option>\
 </select>\
</div>\
   <div class="col-md-2">\
   <select class="form-control select2 " data-placeholder="Nama Perusahaan">\
   <option></option>\
   <option>Perusahaan 1</option>\
   <option>Perusahaan 2</option>\
   <option>Perusahaan 3</option>\
   <option>Perusahaan 4</option>\
   <option>Perusahaan 5</option>\
   <option>Perusahaan 6</option>\
   <option>Perusahaan 7</option>\
   <option>Perusahaan 8</option>\
   <option>Perusahaan 9</option>\
   <option>Perusahaan 10</option>\
 </select>\
</div>\
             <div class="col-md-1">\
             <select class="form-control select2" name="Kriteria Dampak" data-placeholder="Kriteria Dampak">\  <option value=""></option>\
             <option>Ringan</option>\
             <option>Sedang</option>\
             <option>Berat</option>\
             <option>Fatality</option>\
         </select>\
         </div>\
         <div class="col-md-3">\
         <textarea name="deskripsi" placeholder="Deskripsi" class="form-control" rows="3"></textarea>\
     </div>\
     <div class="button-group">\
                 <button type="button" class="btn btn-success btn-tambah"><i class="fa fa-plus"></i></button>\
                 <button type="button" class="btn btn-danger btn-hapus"><i class="fa fa-times"></i></button>\
             </div>\
      </div>'
   $("#dynamic_form3").append(addrow3);
}

$("#dynamic_form3").on("click", ".btn-tambah", function(){
   addForm3()
   $(this).css("display","none")     
   var valtes = $(this).parent().find(".btn-hapus").css("display","");
})

$("#dynamic_form3").on("click", ".btn-hapus", function(){
 $(this).parent().parent('.baru-data3').remove();
 var bykrow3 = $(".baru-data3").length;
 if(bykrow3==1){
   $(".btn-hapus").css("display","none")
   $(".btn-tambah").css("display","");
 }else{
   $('.baru-data3').last().find('.btn-tambah').css("display","");
 }
});



$('.btn-simpan').on('click', function () {
   $('#dynamic_form3').find('input[type="text"], input[type="number"], select, textarea').each(function() {
      if( $(this).val() == "" ) {
         event.preventDefault()
         $(this).css('border-color', 'red');
         
         $(this).on('focus', function() {
            $(this).css('border-color', '#ccc');
         });
      }
   })
})




function addForm4(){
   var addrow4 = '<div class="col-sm-12" >\
   <div class="form-group baru-data4 row">\
   <div class="col-md-3">\
   <input type="text" name="Lingkungan" placeholder="Dampak Lingkungan" class="form-control">\
</div>\
<div class="col-md-3">\
<select class="form-control select2" name="Kriteria Dampak" data-placeholder="Kriteria Dampak">\  <option value=""></option>\
<option>Ringan</option>\
<option>Sedang</option>\
<option>Berat</option>\
<option>Fatality</option>\
</select>\
         </div>\
         <div class="col-md-3">\
         <textarea name="deskripsi" placeholder="Deskripsi" class="form-control" rows="3"></textarea>\
     </div>\
     <div class="button-group">\
                 <button type="button" class="btn btn-success btn-tambah"><i class="fa fa-plus"></i></button>\
                 <button type="button" class="btn btn-danger btn-hapus"><i class="fa fa-times"></i></button>\
             </div>\
      </div>'
   $("#dynamic_form4").append(addrow4);
}

$("#dynamic_form4").on("click", ".btn-tambah", function(){
   addForm4()
   $(this).css("display","none")     
   var valtes = $(this).parent().find(".btn-hapus").css("display","");
})

$("#dynamic_form4").on("click", ".btn-hapus", function(){
 $(this).parent().parent('.baru-data4').remove();
 var bykrow4 = $(".baru-data4").length;
 if(bykrow4==1){
   $(".btn-hapus").css("display","none")
   $(".btn-tambah").css("display","");
 }else{
   $('.baru-data4').last().find('.btn-tambah').css("display","");
 }
});



$('.btn-simpan').on('click', function () {
   $('#dynamic_form4').find('input[type="text"], input[type="number"], select, textarea').each(function() {
      if( $(this).val() == "" ) {
         event.preventDefault()
         $(this).css('border-color', 'red');
         
         $(this).on('focus', function() {
            $(this).css('border-color', '#ccc');
         });
      }
   })
})





function addForm6(){
   var addrow6 = '<div class="col-sm-12" >\
   <div class="form-group baru-data6 row">\
   <div class="col-md-4">\
   <select class="form-control select2 " data-placeholder="Nama Aktor">\
   <option></option>\
   <option>NIP123 - Anton | SPMT Aktor</option>\
   <option>NIP456 - Budi | SPMT</option>\
   <option>NIP789 - Cahyono | PT ABC</option>\
   <option>NIP001 - Dewi Intan | PT XYZ</option>\
   <option>NIP002 - Fransisca | CV Anu</option>\
   <option>NIP003 - Gator Suseno | PT Sejahtera</option>\
   <option>NIP011 - Haryadi Eko, ST, M.Kom | PT Truck Gandeng</option>\
   <option>NIP005 - Iwan Cahaya | PT Berkah Sentosa Adidaya</option>\
   <option>NIP006 - Joko Lelono, ST | CV Nganu</option>\
   <option>NIP007 - Ketut Wangi | PT Mendoakan</option>\
 </select>\
</div>\
<div class="col-md-1">\
<!--<select class="form-control select2" name="pekerjaan" data-placeholder="Pekerjaan">\
    <option></option>\
    <option>Pekerjaan 1</option>\
    <option>Pekerjaan 2</option>\
    <option>Pekerjaan 3</option>\
    <option>Pekerjaan 4</option>\
</select>-->\
</div>\
<div class="button-group  col-md-1">\
                 <button type="button" class="btn btn-success btn-tambah"><i class="fa fa-plus"></i></button>\
                 <button type="button" class="btn btn-danger btn-hapus"><i class="fa fa-times"></i></button>\
             </div>\
      </div>'
   $("#dynamic_form6").append(addrow6);
}

$("#dynamic_form6").on("click", ".btn-tambah", function(){
   addForm6()
   $(this).css("display","none")     
   var valtes = $(this).parent().find(".btn-hapus").css("display","");
})

$("#dynamic_form6").on("click", ".btn-hapus", function(){
 $(this).parent().parent('.baru-data6').remove();
 var bykrow6 = $(".baru-data6").length;
 if(bykrow6==1){
   $(".btn-hapus").css("display","none")
   $(".btn-tambah").css("display","");
 }else{
   $('.baru-data6').last().find('.btn-tambah').css("display","");
 }
});



$('.btn-simpan').on('click', function () {
   $('#dynamic_form6').find('input[type="text"], input[type="number"], select, textarea').each(function() {
      if( $(this).val() == "" ) {
         event.preventDefault()
         $(this).css('border-color', 'red');
         
         $(this).on('focus', function() {
            $(this).css('border-color', '#ccc');
         });
      }
   })
})





function addForm60(){
   var addrow60 = '<div class="col-sm-12" >\
   <div class="form-group baru-data60 row">\
   <div class="col-md-3">\
   <input type="text" name="nama_saksi" placeholder="Nama Saksi" class="form-control">\
</div>\
<div class="col-md-3">\
   <input type="text" name="NIK" placeholder="NIK" class="form-control">\
</div>\
<div class="col-md-3">\
   <input type="text" name="perusahaan" placeholder="Nama Perusahaan" class="form-control">\
</div>\
<div class="col-md-2">\
   <input type="text" name="pekerjaan" placeholder="Pekerjaan" class="form-control">\
</div>\
<div class="button-group">\
                 <button type="button" class="btn btn-success btn-tambah"><i class="fa fa-plus"></i></button>\
                 <button type="button" class="btn btn-danger btn-hapus"><i class="fa fa-times"></i></button>\
             </div>\
      </div>'
   $("#dynamic_form60").append(addrow60);
}

$("#dynamic_form60").on("click", ".btn-tambah", function(){
   addForm60()
   $(this).css("display","none")     
   var valtes = $(this).parent().find(".btn-hapus").css("display","");
})

$("#dynamic_form60").on("click", ".btn-hapus", function(){
 $(this).parent().parent('.baru-data60').remove();
 var bykrow60 = $(".baru-data60").length;
 if(bykrow60==1){
   $(".btn-hapus").css("display","none")
   $(".btn-tambah").css("display","");
 }else{
   $('.baru-data60').last().find('.btn-tambah').css("display","");
 }
});



$('.btn-simpan').on('click', function () {
   $('#dynamic_form60').find('input[type="text"], input[type="number"], select, textarea').each(function() {
      if( $(this).val() == "" ) {
         event.preventDefault()
         $(this).css('border-color', 'red');
         
         $(this).on('focus', function() {
            $(this).css('border-color', '#ccc');
         });
      }
   })
})



function addForm7(){
   var addrow7 = '<div class="col-sm-12" >\
   <div class="form-group baru-data7 row">\
       <div class="col-md-2">\
       <select class="form-control select2" name="Kategori" data-placeholder="Kategori">\
       <option>People</option>\
       <option>Place</option>\
       <option>Part</option>\
       <option>Paper</option>\
   </select>\
       </div>\
       <div class="col-md-3">\
       <select class="form-control select2" name="Kategori" data-placeholder="PIC">\
       <option>NIP - nama - Branch Manager Dumai 7</option>\
       <option>NIP - nama - Branch Manager Dumai</option>\
       <option>NIP - nama - Branch Manager Makassar</option>\
       <option>NIP - nama - SVP Manajemen Risiko</option>\
       <option>NIP - nama - SVP Pengelolaan Keuangan & Perpajakan</option>\
       <option>NIP - nama - SVP Anggaran, Akuntansi, & Pelaporan</option>\
       <option>NIP - nama - SVP Hukum</option>\
       <option>NIP - nama - SVP Perencanaan & Pengembangan Operasi</option>\
       <option>NIP - nama - SVP Sekretariat Perusahaan</option>\
   </select></div>\<div class="col-md-4">\
         <textarea name="Uraian" placeholder="Uraian" class="form-control" rows="2"></textarea>\
       </div>\
       <div class="col-md-2">\
       <input type="date" name="duedate" placeholder="Tenggat Waktu" class="form-control">\
       </div>\
       <div class="button-group">\
           <button type="button" class="btn btn-success btn-tambah"><i class="fa fa-plus"></i></button>\
           <button type="button" class="btn btn-danger btn-hapus" style="display:none;"><i class="fa fa-times"></i></button>\
       </div>\
       </div>\
</div>'
   $("#dynamic_form7").append(addrow7);
}

$("#dynamic_form7").on("click", ".btn-tambah", function(){
   addForm7()
   $(this).css("display","none")     
   var valtes = $(this).parent().find(".btn-hapus").css("display","");
})

$("#dynamic_form7").on("click", ".btn-hapus", function(){
 $(this).parent().parent('.baru-data7').remove();
 var bykrow7 = $(".baru-data7").length;
 if(bykrow7==1){
   $(".btn-hapus").css("display","none")
   $(".btn-tambah").css("display","");
 }else{
   $('.baru-data7').last().find('.btn-tambah').css("display","");
 }
});



$('.btn-simpan').on('click', function () {
   $('#dynamic_form7').find('input[type="text"], input[type="number"], select, textarea').each(function() {
      if( $(this).val() == "" ) {
         event.preventDefault()
         $(this).css('border-color', 'red');
         
         $(this).on('focus', function() {
            $(this).css('border-color', '#ccc');
         });
      }
   })
})