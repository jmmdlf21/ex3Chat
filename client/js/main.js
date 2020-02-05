let gestionClavardage = function() {

	const BASE_URI = "http://localhost:8080/p51/serveur/";
	// const BASE_URI = "http://localhost/p51/serveur/";

	var delai = 10000;
	var dernierId = "empty";	// Valeur empty pour initialiser le dernier id pour la premiere fois

	let oGestionClavardage = {

		/**
		 * Récupération de la liste des messages
		 * avec une requête ajax
		 */
		listerMessages() {
			this.afficherTemplate();
			
			initialiser();
			setInterval(initialiser, delai);

			function initialiser() {
				//let donnees = {dernierId: dernierId};
				$.ajax({url: BASE_URI+"listeMessages.php?dernierId="+dernierId, type: "GET", cache:false}).
				done((messagesJson) => {
					let messages = JSON.parse(messagesJson);
					oGestionClavardage.afficherMessages(messages);
				}).
				fail(oGestionClavardage.afficherErreur);
			}
		},

		/**
		 * Récupération de la liste des clients
		 * avec une requête ajax
		 *//*
		listerClients() {
			$.get({url: BASE_URI+"listeClients.php", cache:false}).
			done((clientsJson) => {
				let clients = JSON.parse(clientsJson);
				this.afficherClients(clients);	
			}).
			fail(this.afficherErreur);
		},*/


		
		/**
		 * Ajoute un message a la base de données
		 * avec une requête ajax
		 */
		ajouterMessage() {

			let message = form1.message.value;
			form1.texte.value = "";

			if(message != "") {
				let donnees = {message: message};

				$.ajax({url:BASE_URI+"ajouteMessage.php", data: donnees, type: "POST"}).
				done((reponseJson) => {
					let reponse = JSON.parse(reponseJson);
				}).
				fail(this.afficherErreur);
			}
		},

		/**
		 * Formulaire d'ajout d'un client
		 * avec une requête ajax
		 *
		ajouterClient() {
			$("#wrapper").html("");
			let t = $("#t-clientAjout").prop("content");
			let tClone = t.cloneNode(true);
			$("#wrapper").append(tClone);
			$("#bValider").click(() => {
				if (this.controlerSaisie()) {
					
					// 1ière possibilité: format XHR avec jQuery serialize
					// --------------------------------------------------- 
					// let donnees = $("form").serialize();

					// 2ième possibilité: format XHR codé directement
					// ----------------------------------------------
					// let donnees = "client_nom="+frm.client_nom.value+"&";
					// donnees    += "client_prenom="+frm.client_prenom.value+"&";
					// donnees    += "client_date_naissance="+frm.client_date_naissance.value+"&";
					// donnees    += "client_telephone="+frm.client_telephone.value;
					
					// 3ième possibilité: objet littéral transformé par jQuery en format XHR
					// --------------------------------------------------------------------- 
					let donnees = {
						client_nom:            frm.client_nom.value,
						client_prenom:         frm.client_prenom.value,
						client_date_naissance: frm.client_date_naissance.value,
						client_telephone:      frm.client_telephone.value	
					}

					$.ajax({url:BASE_URI+"ajouteClient.php", data: donnees, type: "POST"}).
					done((reponseJson) => {
						let reponse = JSON.parse(reponseJson);
						let ret = "Client " + (reponse['ret'] ? "" : " non") + " ajouté."; 
						this.afficherClients(reponse['clients'], ret);	
					}).
					fail(this.afficherErreur);
				}
			});
		},


		/**
		 * Formulaire de modification d'un client
		 * avec une requête ajax
		 */
		modifierClient() {
			$("#wrapper").html("");
			let t = $("#t-clientModification").prop("content");
			let tClone = t.cloneNode(true);
			let e = tClone.lastElementChild;
			let id = event.target.dataset.id;
			$.get({url: BASE_URI+"getClient.php?id="+id, cache:false}).
			done((clientJson) => {
				let c = JSON.parse(clientJson);
				$(e).html(eval("`"+$(e).html()+"`"));
				$("#wrapper").append(tClone);
				$("#bValider").click(() => {
					if (this.controlerSaisie()) {
						let donnees = $("form").serialize();
						console.log(donnees);
						$.ajax({url:BASE_URI+"modifieClient.php", data: donnees, type: "PUT"}).
						done((reponseJson) => {
							let reponse = JSON.parse(reponseJson);
							let ret = "Client numéro " + id + (reponse['ret'] ? "" : " non") + " modifié."; 
							this.afficherClients(reponse['clients'], ret);	
						}).
						fail(this.afficherErreur);
					}
				});
			}).
			fail(this.afficherErreur);
		},

		/**
		 * Suppression d'un client
		 * avec une requête ajax
		 */
		supprimerClient() {
			let id = event.target.dataset.id;
			$.ajax({url:BASE_URI+"supprimeClient.php?id="+id, type:"DELETE"}).
			done((reponseJson) => {
				let reponse = JSON.parse(reponseJson);
				let ret = "Client numéro " + id + (reponse.ret ? "" : " non") + " supprimé."; 
				this.afficherClients(reponse.clients, ret);	
			}).
			fail(this.afficherErreur);
		},


		/**
		 * Affichage d'un message d'erreur suite à un problème technique
		 * en retour d'une requête ajax
		 */
		afficherErreur(erreur) {
			$("#wrapper").html("");
			$("#erreur").html(
				"Problème technique<br>" +
				"Erreur:" + erreur.status + " " + erreur.statusText + "<br>" +
				erreur.responseText);
		},

		/**
		 * Ajoute le template au code
		 */		
		afficherTemplate() {
			let t = $("#t-clavardage").prop("content");
			let tClone = t.cloneNode(true);
			$("#clavardage").append(tClone);		 
		},

		/**
		 * Affichage des messages
		 * en retour d'une requête ajax
		 */
		afficherMessages(messages, ret) {
			$("#contenu").html("");
			$(messages).each(function(i, m) {
				heure = m.date_heure.substr(11, 5);
				message =  "<li class='message'>" + heure + " - " + m.pseudo + "> "; 
				message += m.message + "</li><br>";
				$("#contenu").append(message);
			});

			// Gestionaire d'evenement
			$("#soumettre").click(this.ajouterMessage.bind(this));
		},


		/**
		 * Affichage de la liste des clients
		 * en retour d'une requête ajax
		 *
		afficherClients(clients, ret) {
			
			// réinitialisation de la zone d'affichage dynamique
			// ---
			$("#wrapper").html("");
			
			// insertion de l'en-tête fixe à partir d'un clone du template (t)
			// ---
			let t = $("#t-clientsListe").prop("content");
			let tClone = t.cloneNode(true);
			$("#wrapper").append(tClone);
			if (ret) $("#ret").html(ret);
			
			// insertion de chaque ligne client à partir d'un clone du sous-template (t2)
			// ---
			let t2 = $("#t-clientsListeItem").prop("content");
			$(clients).each(function(i, c) {
				let t2Clone = t2.cloneNode(true).firstElementChild;
				$(t2Clone).html(eval("`"+$(t2Clone).html()+"`"));
				$("#wrapper").append(t2Clone);
			});
			
			// création des listeners associés aux spans des actions
			// ---
			$("[data-action='ajouter']").click(this.ajouterClient.bind(this));
			$("[data-action='supprimer']").click(this.supprimerClient.bind(this));
			$("[data-action='modifier']").click(this.modifierClient.bind(this));
		},

		/**
		 * Contrôle de la saisie
		 */
		controlerSaisie() {
			return true;
		}
	}
	return oGestionClavardage;
}();