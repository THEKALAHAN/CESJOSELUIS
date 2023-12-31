<footer id="footer" class="bg-blue-dark">
    <section class="container-fluid p-3">
        <div class="row text-white justify-content-center">
           <div class="col-md-2">
            <img id="img_logo_signup" src="{{asset('img/logo-min.png')}}" alt="">
           </div>
           <div class="col-md-3">
            <h2><strong>NOSOTROS</strong></h2>
               <p>Centro Comercial José Luis es un proyecto que apuesta por traer al municipio de Barbosa Antioquia los productos y servicios de grandes empresas, con instalaciones modernas que ofrece a nuestros visitantes una experiencia agradable e inolvidable.</p>
           </div>
           <div class="col-md-2">
            <h2><strong>MENÚ</strong></h2>
               <ul class="nav flex-column">
                   <li class="nav-item">
                     <a class="nav-link text-white js-scroll-trigger" href="#header">Inicio</a>
                   </li>
                   <li class="nav-item">
                     <a class="nav-link text-white js-scroll-trigger" href="#about">Nosotros</a>
                   </li>
                   <li class="nav-item">
                     <a class="nav-link text-white js-scroll-trigger" href="#estate">Tiendas</a>
                   </li>
                   <li class="nav-item">
                     <a class="nav-link text-white js-scroll-trigger" href="#service">Servicios</a>
                   </li>
                   {{-- <li class="nav-item">
                     <a class="nav-link text-white js-scroll-trigger" href="#signup">Contáctanos</a>
                   </li> --}}
               </ul>
           </div>
           {{-- <div class="col-md-2">
               <h3>Comercial</h3>
            </div> --}}
            {{-- <div class="col-md-2">
                <H2><STRong>SIGUENOS</STRong></H2>
                <div class="social">
                    <a class="mx-2" target="_blank" href=""><i class="fab fa-instagram"></i></a>
                    <a href="https://www.facebook.com/centrocomercialjoseluis"><i class="fab fa-facebook"></i></a>
                </div>
           </div> --}}
           <div class="col-md-3">
               <h2><strong>VISITANOS</strong></h2>
               {{-- <a class="nav-link text-white js-scroll-trigger">Contáctanos</a>
               <p class="text-white">Cra. 15 #10-40 Barbosa Antioquia</p> --}}
               <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d991.356534374705!2d-75.3330542708262!3d6.436141132361495!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8e44161b02a28a2b%3A0xe0e5afaa2d870a65!2sCra.+15+%231030%2C+Barbosa%2C+Antioquia!5e0!3m2!1ses!2sco!4v1550095689705" width="100%" height="60%" frameborder="0" style="border:0" allowfullscreen></iframe>
           </div>
           <div class="col-md-1"></div>
           <div class="col-md-12 text-center">
               <a class="text-white" target="_blank" href="{{asset('files/pages/REGLAMENTO DE')}} USUARIOS.pdf">REGLAMENTO DE USUARIOS</a>
           </div>
       </div>
    </section>
</footer>

@section('css')

@endsection
