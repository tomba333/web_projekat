<?php
include 'dbo-conn.php';

$conn = OpenCon();



CloseCon($conn);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
   
    
    <link rel="stylesheet" href="./style.css">

    
        
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href='https://cdn.jsdelivr.net/npm/boxicons@2.0.5/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="./timepicker/jquery.timepicker.css"/>
    <script src="./timepicker/jquery.timepicker.min.js"></script>
    <script src="./jquery-ui-1.13.2/jquery-ui.js"></script>
    <link rel="stylesheet" href="./jquery-ui-1.13.2/jquery-ui.css">

    <title>Koliba</title>
</head>
<body>
    <script >
      
          fetch('cicina-koliba-food.json')
        .then(function (response) {
            return response.json();
        })
        .then(function (data) {
            
            appendData(data);
        })
        .catch(function (err) {
            alert("err");
            console.log('error: ' + err);
        });

    function appendData(data) {
         var typeOfFoodCont;
        for( let i=0;i<data.kategorije.length;i++){
          
            var typeOfFoodCont;
            if(i==0){
                    typeOfFoodCont = document.getElementById("rostiljCont");
            }
            else if(i==1){
                    typeOfFoodCont = document.getElementById("pizzaCont");
            }
            else{
                    typeOfFoodCont = document.getElementById("tjesteninaCont");
            }
            
            addItem(data,i,typeOfFoodCont);
        }

        }
        
    function addItem(data,kategorija,container){
        
        for (let i = 0; i < data.items.length; i++) {
            if(kategorija==data.items[i].category){

                let menuItem = document.createElement("div");
                menuItem.classList.add("menu-item");
                container.appendChild(menuItem);
                
                let divItemImg=document.createElement("img");
                divItemImg.src=data.items[i].image_path;
                divItemImg.classList.add("menu-item-image")
               menuItem.appendChild(divItemImg);
                
               let menuItemText = document.createElement("div");
                menuItemText.classList.add("menu-item-text");
                menuItem.appendChild(menuItemText);

                    let menuItemHeading=document.createElement("h3");
                    menuItemHeading.classList.add("menu-item-heading");
                    menuItemText.appendChild(menuItemHeading);

                        let menuItemName = document.createElement("span");
                        menuItemName.classList.add("menu-item-name");
                        menuItemName.innerHTML =  data.items[i].name ;
                        menuItemHeading.appendChild(menuItemName);

                        let menuItemPrice = document.createElement("span");
                        menuItemPrice.classList.add("menu-item-price");
                        menuItemPrice.innerHTML =  data.items[i].price ;
                        menuItemHeading.appendChild(menuItemPrice);

                    let menuItemDescription=document.createElement("p");
                    menuItemDescription.classList.add("menu-item-description");
                    menuItemDescription.innerHTML =  data.items[i].description ;
                    menuItemText.appendChild(menuItemDescription);

                    
            }
        }
    }

           $(document).ready(function () {
           
            


            $('body').on('click','#headerRostilj', function(){
                    $('#rostiljCont').slideToggle();
            })

            $('body').on('click','#headerPizza', function(){
                    $('#pizzaCont').slideToggle();
            })
            $('body').on('click','#headerTjestenina', function(){
                    $('#tjesteninaCont').slideToggle();
            })
            
            $(".BBQFood").click(function () {
                    if ($(this).parent(".roštilj-container").children(".image").length) {
                        $(this).parent(".roštilj-container").children(".image").toggle();  
                    } else {
                        var image_name='hamburger.png';
                        var imageTag='<div class="image">'+'<img src="./'+image_name+'" alt="image" height="100" />'+'</div>';
                        $(this).parent('.roštilj-container').append(imageTag);
                    }
                    });


        
                var name ="";
                var time;
                $('#Time').on("change",function(){
                    $('#Time').timepicker('hide');
                });
                $(".datum").on('blur',function(){
                    var times=[];
                    var json;
                    var xmlhttp = new XMLHttpRequest();
                    xmlhttp.onload = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        json = this.responseText;
                        
                        if(!json){
                            time = $('#Time').timepicker({
                        'timeFormat': 'H:i',
                        'step': 60,
                        'minTime': '10',
                        'maxTime':'23',
                        'closeOnWindowScroll': true,
                        'forceRoundTime': true, 
                            });  
                        }else{
                            times = JSON.parse(json.split(','));
                            time = $('#Time').timepicker({
                        'timeFormat': 'H:i',
                        'step': 60,
                        'minTime': '10',
                        'maxTime':'23',
                        'closeOnWindowScroll': true,
                        'forceRoundTime': true, 
                        'disableTimeRanges':[
                            [times[0], times[1]],
                            [times[2], times[3]],
                            [times[4], times[5]],
                            [times[6], times[7]],
                            [times[8], times[9]],
                            ],
                            });
                        }
                    
                    }
                    };
                    xmlhttp.open("get","times.php?q="+$('.datum').val()+"&p="+name,true);
                    xmlhttp.send();
                });
                var today = new Date().toISOString().split('T')[0];
                 $('.datum').attr('min', today)
                $(".table").click(function (){
                        $(".content").show();
                        $(".content").children(".table-name").text(name = $(this).attr('alt'));
                })
                $(".close-btn").click(function(){
                    $("#form_reservation").each(function(){
                    this.reset();})
                    $('#Time').timepicker('remove');
                    $(".content").toggle();
                })
                $(".submit").click(function(event){
                    var formData = {
                    ime: $(".ime").val(),
                    prezime: $(".prezime").val(),
                    email: $(".email").val(),
                    datum: $(".datum").val(),
                    vrijeme:time.val(),
                    br_gostiju : $(".br_gostiju").val(),
                    stol : name
                    };
                    let regex = new RegExp(/^[a-zA-Z]+(-[a-zA-Z]+)*$/);
                    let regex_email = new RegExp(/[a-z0-9]+@[a-z]+\.[a-z]{2,3}/);
                    let form_flag = true;
                    let regex_num = new RegExp(/^[1-4]*$/);
                    if(formData['ime'] === "" || formData['prezime']==="" || formData['email']==="" || formData['datum'] === "" || formData['br_gostiju']=== ""||formData['vrijeme'] === ""){
                        alert("Polja nisu unesena.");
                        let form_flag = false;
                            
                    }else if(!regex.test(formData['ime']) ){
                        alert("Pogrešno uneseno: Ime");
                        form_flag = false;
                         }
                        else if(!regex.test(formData['prezime']) ){
                        alert("Pogrešno uneseno: Prezime");
                        form_flag = false;
                        }
                        else if(!regex_email.test(formData['email'])){
                        alert("Pogrešno unesen: Email");
                        form_flag = false;
                        }else if(!regex_num.test(formData['br_gostiju'])){
                        alert("Pogrešno unesen broj gostiju!");
                        form_flag = false;
                        }else{
                        if(form_flag){
                        $.ajax(
                        {
                        url: "insert.php",
                        type: "POST",
                        async:false,
                        data: formData,
                        dataType: "json",
                        });     
                         $("#form_reservation").each(function(){
                                this.reset();})
                                $(".content").toggle();
                                    
                        
                            }
                            }
                        
    
                });
             



            });
            
               

  

    </script>
     

    <main class="l-main">
   

        
        
        
       <!--Sadržaj web apk-->
    
        <!--========== HEADER ==========-->
        <header class="l-header" id="header">
            <nav class="nav bd-container">
                <a href="#" class="nav__logo">Čićina koliba</a>

                <div class="nav__menu" id="nav-menu">
                    <ul class="nav__list" id="navList">
                        
                        <li class="nav__item"><a href="#about" class="nav__link">O nama</a></li>
                        
                        <li class="nav__item"><a href="#menu" class="nav__link">Jelovnik</a></li>
                        <li class="nav__item"><a href="#rezervacija" class="nav__link">Rezervacija</a></li>
                        <li class="nav__item"><a href="#kontakt" class="nav__link">Kontakt</a></li>

                       
                    </ul>
                </div>
                <div class="nav__toggle" id="nav-toggle">
                    <i class='bx bx-menu'></i>
                </div>
            
            </nav>

        </header>
        
        <section class="home" id="home">
            
                <div class="slideshow-container">

                    <div class="mySlides fade">
                    <div class="numbertext">1 / 3</div>
                    <img src="entryImage1.jpg" style="width:100%">
                    
                    </div>

                    <div class="mySlides fade">
                    <div class="numbertext">2 / 3</div>
                    <img src="entryImage2.jpg" style="width:100%">
                    
                    </div>

                    <div class="mySlides fade">
                    <div class="numbertext">3 / 3</div>
                    <img src="entryImage3.jpg" style="width:100%">
                    
                    </div>

                 </div>
                    <br>

                    <div style="text-align:center">
                    <span class="dot"></span> 
                    <span class="dot"></span> 
                    <span class="dot"></span> 
                    </div>
    
                    
           
        </section>
        <script>
        let slideIndex = 0;
        showSlides();

        function showSlides() {
            let i;
            let slides = document.getElementsByClassName("mySlides");
            let dots = document.getElementsByClassName("dot");
            for (i = 0; i < slides.length; i++) {
                slides[i].style.display = "none";  
            }
            slideIndex++;
            if (slideIndex > slides.length) {slideIndex = 1}    
            for (i = 0; i < dots.length; i++) {
                dots[i].className = dots[i].className.replace(" active", "");
            }
            slides[slideIndex-1].style.display = "block";  
            dots[slideIndex-1].className += " active";
            setTimeout(showSlides, 5000);
        }
        </script>
        
            <section class="about section bd-container" id="about">
                <div class="about__container  bd-grid">
                    <div class="about__data">
                        <span class="section-subtitle about__initial">O nama</span>
                        <h2 class="section-title about__initial">Domaće  i svježe</h2>
                        <p class="about__description">Restoran s dugom tradicijom. Sva hrana dolazi na stol svježe pripremljena pri čemu koristimo samo domaće namirnice.</p>
                        
                    </div>

                    <img src="Images/Rostilj/biftek.jpg" alt="" class="about__img">
                </div>
            </section>

        <!--Cijenik-->

        
        
        <section class="menu section bd-container" id="menu">
                
                <h2 class="section-title">Jelovnik</h2>
        
            
        <div class="main">
            <h4><a href="javascript:void(0)"  id="headerRostilj"> Roštilj</a></h4>
            
            <div class="menus" id="rostiljCont" style="display: none;" >
                 
            </div>
            <h4><a href="javascript:void(0)"  id="headerPizza"> Pizza</a></h4>
            
            <div class="menus" id="pizzaCont" style="display: none;" >
                   
            </div>
            <h4><a href="javascript:void(0)"  id="headerTjestenina">Tjestenina</a></h4>
            <div class="menus" id="tjesteninaCont" style="display: none;" > </div>

        </div>
        
    
        </section>

    

    
    <!--Reservacije-->
    <section class="rezervacija section bd-container" id="rezervacija">
    <h2 class="section-title">Rezerviraj stol</h2>
        <span id="content-divider"></span>
        <img src="restaurant-plan.png" alt="Sjedala" usemap="#rezervacija" id="rezervacijaImg">

        <map name="rezervacija">
          <area class="table" shape="circle" coords="92,72,24" alt="SepareLijevi1" href="#content">
          <area class="table" shape="circle" coords="202,72,24" alt="SepareLijevi2" href="#content">
          <area class="table" shape="circle" coords="430,72,24" alt="SepareDesni1" href="#content">
          <area class="table" shape="circle" coords="552,72,24" alt="SepareDesni2" href="#content">
          <area class="table" shape="circle" coords="74,184,22" alt="Obiteljski1" href="#content">
          <area class="table" shape="circle" coords="74,250,22" alt="Obiteljski2" href="#content">
          <area class="table" shape="circle" coords="74,314,22" alt="Obiteljski3" href="#content">
          <area class="table" shape="circle" coords="208,170,20" alt="Okrugli4Lijevo1" href="#content">
          <area class="table" shape="circle" coords="208,228,20" alt="Okrugli4Lijevo2" href="#content">
          <area class="table" shape="circle" coords="208,296,20" alt="Okrugli4Lijevo3" href="#content">
          <area class="table" shape="circle" coords="266,170,20" alt="Okrugli4Lijevo4" href="#content">
          <area class="table" shape="circle" coords="266,228,20" alt="Okrugli4Lijevo5" href="#content">
          <area class="table" shape="circle" coords="266,296,20" alt="Okrugli4Lijevo6" href="#content">
          <area class="table" shape="circle" coords="388,170,20" alt="Okrugli4Desni1" href="#content">
          <area class="table" shape="circle" coords="388,228,20" alt="Okrugli4Desni2" href="#content">
          <area class="table" shape="circle" coords="388,296,20" alt="Okrugli4Desni3" href="#content">
          <area class="table" shape="circle" coords="446,170,20" alt="Okrugli4Desni4" href="#content">
          <area class="table" shape="circle" coords="446,228,20" alt="Okrugli4Desni5" href="#content">
          <area class="table" shape="circle" coords="446,296,20" alt="Okrugli4Desni6" href="#content">
          <area class="table" shape="circle" coords="559,171,10" alt="Okrugli2Desni1" href="#content">
          <area class="table" shape="circle" coords="559,215,10" alt="Okrugli2Desni2" href="#content">
          <area class="table" shape="circle" coords="559,257,10" alt="Okrugli2Desni3" href="#content">
          <area class="table" shape="circle" coords="559,301,10" alt="Okrugli2Desni4" href="#content">
        </map> 
        <!--POPUP-->
        <div class="content">
            <div class="close-btn">
                ×
            </div>
            <h3 class="table-name"></h3>
                <form method="post" action="insert.php" id="form_reservation" class="was-validatedr">
                    <div class="row">
                      <div class="col">
                        <label for="validationServer01" class="form-label"></label>
                        <input type="text" class="form-control ime" id="validationServer01" placeholder="Ime" required>
                        
                      </div>
                      <div class="col">
                      <label for="validationServer02" class="form-label"></label>
                        <input type="text" class="form-control prezime" id="validationServer02" placeholder="Prezime" required>
                      </div>
                    </div> 
                    <div class="row">
                      <div class="col">
                      <label for="validationServer03" class="form-label"></label>
                        <input type="text" class="form-control email" id="validationServer03" placeholder="Email" required>
                      </div>
                      <div class="col">
                      <label for="validationServer05" class="form-label"></label>
                        <input type="text" class="form-control br_gostiju" id="validationServer04" placeholder="Broj gostiju" required>
                      </div>
                    </div>
                    <div class="row">
                    <div class="col">
                      <label for="validationServer04" class="form-label" ></label>
                        <input type="date"   class="form-control datum" id="validationServer05" placeholder="Datum" required />
                    </div>
                    <div class="col">
                    <label for="Time" class="form-label" ></label>
                        <input type="text" class="form-control" id="Time" class="vrijeme" placeholder="Vrijeme" required />
                    </div>
                 </div>
                 </form>
                    <div class="row">
                         <div class="col">
                            <label for="submit" class="form-label"></label>
                             <button type="submit" class="submit form-control" value="Submit" name="submit">Submit</button>
                         </div>
                    </div>              
        </div>
        
        </section>

    <span id="content-divider"></span>
    <section id="kontakt">
        <!--========== FOOTER ==========-->
        <footer class="footer section bd-container">
            <div class="footer__container bd-grid">
                <div class="footer__content" >
                    <a href="#" class="footer__logo">Čićina Koliba</a>
                    <span class="footer__description">Restoran</span>
                    <ul class="footer__description">
                        <li>Radno vrijeme:</li>
                        <li>Pon-Ned: 10 - 23</li>
                     </ul>
                    <div>
                        <a href="#" class="footer__social"><i class='bx bxl-facebook'></i></a>
                        <a href="#" class="footer__social"><i class='bx bxl-instagram'></i></a>
                        <a href="#" class="footer__social"><i class='bx bxl-twitter'></i></a>
                    </div>
                </div>

                <div class="footer__content">
                    <h3 class="footer__title">Usluge</h3>
                    <ul>
                        <li><a href="#rezervacija" class="footer__link">Rezervacija stola</a></li>
                        <li><a href="#menu" class="footer__link">Jelovnik</a></li>
                        
                    </ul>
                </div>


                <div class="footer__content">
                    <h3 class="footer__title">Kontakt</h3>
                    <ul>
                        <li>Leskovac, Srbija</li>
                        <li>Ulica republike 123</li>
                        <li>+38483221465</li>
                        <li>cicinakoliba@email.com</li>
                    </ul>
                </div>
            </div>

            
        </footer>
        </section>

    
        </main>



        <script src="main.js"></script>
    
</body>

</html>
