<?php
	use \Core\Route;
	
	return [
		//Страница с темами
		new Route("/", "main", "index"),
		// страница авторизации
		new Route("/login", "auth", "login"),
		// страница регистрации
		new Route("/register", "register", "signup"),
		// разлогинивание
		new Route("/logout", "logout", "logout"),

		new Route("/topic/:topid", "theme", "show"),
		new Route("/get/:topid", "theme", "ajaxshow"),
		new Route("/user", "theme", "user"),
		new Route("/data/:topid", "theme", "topicData"),
		new Route("/add/:topid", "theme", "added"),
		new Route("/addtop", "main", "add"),
		new Route("/table", "main", "table"),
		new Route("/delete/comment", "theme", "delete"),
		new Route("/delete/topic", "main", "delete"),
		new Route("/error", "error",  "notFound"),

		
	];
	
