<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <title>Hotelier - Hotel HTML Template</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="{{asset('img/favicon.ico')}}" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">  

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{asset('lib/animate/animate.min.css')}}" rel="stylesheet">
    <link href="{{asset('lib/owlcarousel/assets/owl.carousel.min.css')}}" rel="stylesheet">
    <link href="{{asset('lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css')}}" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="{{asset('css/style.css')}}" rel="stylesheet">
</head>

<body>
    <div class="container-xxl bg-white p-0">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->

        <!-- Header Start -->
        <div class="container-fluid bg-dark px-0">
            <div class="row gx-0">
                <div class="col-lg-3 bg-dark d-none d-lg-block">
                    <a href="/" class="navbar-brand w-100 h-100 m-0 p-0 d-flex align-items-center justify-content-center">
                        <h1 class="m-0 text-primary text-uppercase">Hotelier</h1>
                    </a>
                </div>
                <div class="col-lg-9">
                    <nav class="navbar navbar-expand-lg bg-dark navbar-dark p-3 p-lg-0">
                        <a href="/" class="navbar-brand d-block d-lg-none">
                            <h1 class="m-0 text-primary text-uppercase">Hotelier</h1>
                        </a>
                        <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                            <div class="navbar-nav mr-auto py-0">
                                <a href="../dashboard" class="nav-item nav-link ">Home</a>
                                <a href="{{route('chambres.index')}}" class="nav-item nav-link active">Chambres</a>
                                <a href="{{route('reservations.index')}}" class="nav-item nav-link">Reservations</a>
                                <a href="rooms" class="nav-item nav-link">Rooms</a>
                                <div class="nav-item dropdown">
                                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Reservations</a>
                                    <div class="dropdown-menu rounded-0 m-0">
                                        <a href="{{route('reservations.attente')}}" class="dropdown-item">En attente</a>
                                        <a href="{{route('reservations.validee')}}" class="dropdown-item">Validee</a>
                                        <a href="{{route('reservations.refusee')}}" class="dropdown-item">Refusee</a>
                                    </div>
                                </div>
                                <a href="" class="nav-item nav-link">Contact</a>
                            </div>
                            <a href="{{route('logout')}}" class="btn btn-primary rounded-0 py-4 px-md-5 d-none d-lg-block">Deconnexion<i class="fa fa-arrow-right ms-3"></i></a>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
        <!-- Header End -->
         
        <div class="container-fluid pt-5 py-5">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{route('chambres.update', ['chambre' => $chambre->id])}}" method="post" class="form" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <h3 class="text-center mb-4">Modifier la chambre</h3>
                <div class="row">
                    <div class="col-md-6 form-group">
                        <label for="">Titre Chambre <span class="text-danger">*</span></label>
                        <input type="text" value="{{$chambre->titre_chambre}}" placeholder="Entrer le nom de la chambre" name="titre_chambre" class="form-control">
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="">Numero Chambre <span class="text-danger">*</span></label>
                        <input type="number" value="{{$chambre->numero_chambre}}" placeholder="Entrer le numero de la chambre" name="numero_chambre" class="form-control">
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-6">
                        <label for="">Image Principale <span class="text-danger">*</span></label>
                        <img src="{{asset('storage/'.$chambre->image)}}" width="100" alt="{{$chambre->titre_chambre}}">
                        <input type="file" placeholder="entrer l'image principale de la chambre" name="image" class="form-control">
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-6">
                        <label for="">Image Galerie 1<span class="text-danger">*</span></label>
                        <img src="{{asset('storage/'.$chambre->gal_1)}}" width="100" alt="{{$chambre->titre_chambre}}">
                        <input type="file" placeholder="entrer l'image galerie 1 de la chambre" name="gal_1" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label for="">Image Galerie 2<span class="text-danger">*</span></label>
                        <img src="{{asset('storage/'.$chambre->gal_2)}}" width="100" alt="{{$chambre->titre_chambre}}">
                        <input type="file" placeholder="entrer l'image galerie 2 de la chambre" name="gal_2" class="form-control">
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-6 form-group">
                        <label for="">Type de chambre <span class="text-danger">*</span></label>
                        <select name="type_chambre" id="" class="form-control">
                            <option value="{{ $type->nom }}">{{ $type->nom }}</option>
                            @foreach($type_chambre as $type)
                                <option value="{{$type->nom}}">{{$type->nom}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="">Capacité <span class="text-danger">*</span></label>
                        <input type="number" value="{{$chambre->capacite_chambre}}" placeholder="Entrer la capacité de la chambre" name="capacite_chambre" class="form-control">
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-6 form-group">
                        <label for="">Prix <span class="text-danger">*</span></label>
                        <input type="text" value="{{$chambre->prix_chambre}}" name="prix_chambre" class="form-control">
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="">Disponibilite <span class="text-danger">*</span></label>
                        <select name="statut" id="" class="form-control">
                            <option value="{{$chambre->statut}}">{{$chambre->statut}}</option>
                            <option value="Disponible">Disponible</option>
                            <option value="Indisponible">Indisponible</option>
                        </select>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-7">
                        <label for="">Description <span class="text-danger">*</span></label>
                        <textarea name="description" id="" class="form-control">
                            {{$chambre->description}}
                        </textarea>
                    </div>
                    <div class="col-md-5">
                        <label for="">Etat </label><br>
                            @if($chambre->status)
                                <span class="alert-success">Activée</span>
                            @else
                                <span class="alert-danger">Desactivée</span>
                            @endif
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-outline-warning">Modifier</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{asset('lib/wow/wow.min.js')}}"></script>
    <script src="{{asset('lib/easing/easing.min.js')}}"></script>
    <script src="{{asset('lib/waypoints/waypoints.min.js')}}"></script>
    <script src="{{asset('lib/counterup/counterup.min.js')}}"></script>
    <script src="{{asset('lib/owlcarousel/owl.carousel.min.js')}}"></script>
    <script src="{{asset('lib/tempusdominus/js/moment.min.js')}}"></script>
    <script src="{{asset('lib/tempusdominus/js/moment-timezone.min.js')}}"></script>
    <script src="{{asset('lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js')}}"></script>

    <!-- Template Javascript -->
    <script src="{{asset('js/main.js')}}"></script>