
@php

function isActive($path){

  if(Request::path() == $path){
    return "active";
  }

  return Request::path();
}

@endphp

<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="/">BUMDes Bangun Mulyo</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item {{isActive('/')}}">
        <a class="nav-link" href="/">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item {{isActive('category-description')}}">
        <a class="nav-link" href="/category-description">Category</a>
      </li>
      <li class="nav-item {{isActive('analytics')}}">
        <a class="nav-link" href="/analytics">Analytics</a>
      </li>
      <li class="nav-item" id="hidden-gem-unlock" style="width:100px; ">
        <a class="nav-link" id="hidden-gem" style="display:none; width: 200px; " href="https://www.friv.com/" target="_blank">Game</span></a>
      </li>
    </ul>
    <div class="custom-control custom-switch mx-3">
  <input type="checkbox" class="custom-control-input" id="customSwitch1">
  <label class="custom-control-label" for="customSwitch1">Dark Mode</label>
  </div>
  <div class="d-flex flex-column">
  <label >Pilih Bahasa</label>

    <select id="selectlocale">
      <option value="in" selected>Bahasa Indonesia</option>
    <option value="en">English</option>
    </select>

</div>
  </div>
</nav>

<script>
const locale = {
    en: {
        appName: "Guest Book",
        title: "Guest Book UPT TIK UNS",
        btnDownload: "Export Data Guest Book",
        btnAddGuest: "Add Guest",
        tableNumber: "Number",
        tableDate: "Date",
        tableName: "Name",
        tablePhone: "Phone number",
        tableCategory: "Issue Category",
        tableDescription: "Issue Description",
        tableAction: "Action"
    },
    in: {
        appName: "Buku Tamu",
        title: "Buku Tamu UPT TIK UNS",
        btnDownload: "Ekspor Data Tamu",
        btnAddGuest: "Tambah Tamu",
        tableNumber: "No",
        tableDate: "Tanggal",
        tableName: "Nama",
        tablePhone: "No. Telepon",
        tableCategory: "Kategori Keperluan",
        tableDescription: "Deskripsi Keperluan",
        tableAction: "Aksi"
    },
};

$(document).ready(() => {
  const theme = localStorage.getItem("theme");
  if(theme === "dark"){
    $('#customSwitch1').prop('checked',true);
    $('body').addClass('bg-dark')
    $('h1').css('color','#fff');
    $('#guest-datatable').css('color', '#fff')
    $('#guest-datatable').css('background-color', '#000')
    setTimeout(() => {
      $("#guest-datatable_wrapper").css("color", "#fff")
    }, 3000);
  }
});

const changeColor = () => {
    const theme = localStorage.getItem("theme");
  if(theme === "light"){
    localStorage.setItem("theme", "dark");
    $('body').addClass('bg-dark')
    $('h1').css('color','#fff');
    $('#guest-datatable').css('color', '#fff')
    $('#guest-datatable').css('background-color', '#000')
    $("#guest-datatable_wrapper").css("color", "#fff")
  }else{
    localStorage.setItem("theme", "light");
    $('body').removeClass('bg-dark')
    $('h1').css('color','#000');
    $('#guest-datatable').css('color', '#000')
    $('#guest-datatable').css('background-color', '#FFF')
    $("#guest-datatable_wrapper").css("color", "#000")
  }
}

$("#selectlocale").change(() => {
  const selected = $("#selectlocale option:selected").val();

  for (const [key,value] of Object.entries(locale[selected])){
        $(`.${key}`).text(value)
  }
})

$('#hidden-gem-unlock').hover((e)=> {
  const isHidden = $('#hidden-gem').css('display') == "none"
  if(isHidden){
    $('#hidden-gem').css('display','block')
  }else{
    $('#hidden-gem').css('display','none')
  }
})

$('#customSwitch1').change(() => {
  changeColor();
})
</script>
