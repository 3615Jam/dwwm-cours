
// *** 1ere partie *** 



// je commence par définir mon proto : 
const creerEleve = {
	name: "",
	firstname: "",
	age: 0,
}; 

// je demande à Object.create de me créer un objet à partir de mon proto : 
const nouvelEleve = Object.create(creerEleve); 
nouvelEleve.name = "JM";
nouvelEleve.firstname = "Garcia";
nouvelEleve.age = 38; 



// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -



// *** 2eme partie *** 

// fonction constructeur : 
function CreerEleve (name, firstname, age) {
	this.name = name;
	this.firstname = firstname; 
	this.age = age; 
}

// new : 
const newEleve = new CreerEleve ("JM", "Garcia", 38); 
