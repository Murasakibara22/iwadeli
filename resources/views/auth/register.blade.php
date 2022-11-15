<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Troc moi</title>
    <link rel="stylesheet" href="{{ asset('FormStyle/style.css') }}">
</head>
<body>
<h2></h2>
<div class="container" id="container">
	<div class="form-container sign-up-container">
     <form method="POST" action="{{ route('register') }}">
            @csrf
            @method('POST')
			<h1>Inscrivez-vous</h1>
			
			<span></span>
			<input type="text" placeholder="Votre Nom" name="nom" />
			<input type="text" placeholder="Votre prenom" name="prenom" />
			<input type="text" placeholder="Votre Contact" name="contact" value="+225"/>
			<input type="email" placeholder="Email" name="email" />
			<input type="password" placeholder="Password" name="password" />
			<input type="password" placeholder=" Confirm Password" name="password_confirmation" />
			<button type="submit">Valider</button>
		</form>
	</div>
	<div class="form-container sign-in-container" >
     <form method="POST" action="{{ route('login') }}">
            @csrf
			<h1>Login</h1>
			<div class="social-container">
				<a href="#" class="social"><i class="fab fa-facebook-f"></i></a>
				<a href="#" class="social"><i class="fab fa-google-plus-g"></i></a>
				<a href="#" class="social"><i class="fab fa-linkedin-in"></i></a>
			</div>
			<span>Connecter vous ici</span>
			<input type="text" placeholder="Entrer votre contact" name="contact" />
			<input type="password" placeholder="Mot de passe" name="password"  />
			<a href="#">Mot de passe Oublier ?</a>
			<button>Connexion</button>
		</form>
	</div>
	<div class="overlay-container">
		<div class="overlay">
			<div class="overlay-panel overlay-left">
				<h1>Bon retour</h1>
				<p>Rester connecter avec nous en cliquant ici et en entrant vos informations personnels</p>
				<button class="ghost" id="signIn">Connexion</button>
			</div>
			<div class="overlay-panel overlay-right">
				<h1>Salut, Friend!</h1>
				<p>Entrer vos informations et connectez vous facilement</p>
				<button class="ghost" id="signUp">Inscription</button>
			</div>
		</div>
	</div>
</div>

<footer>
	<p>
		Created with <i class="fa fa-heart"></i> by
		<a target="_blank" href="https://florin-pop.com">Florin Pop</a>
		- Read how I created this and how you can join the challenge
		<a target="_blank" href="https://www.florin-pop.com/blog/2019/03/double-slider-sign-in-up-form/">here</a>.
	</p>
</footer>



<script src="{{ asset('FormStyle/main.js') }}"></script>
</body>
</html>