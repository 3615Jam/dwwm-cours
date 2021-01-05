const askUser = () => {
	const userData = {};
	userData.nom = prompt("Quel est ton nom ?");
	userData.prenom = prompt("Quel est ton prénom ?");
	userData.age = Number(prompt("Quel est ton âge ?"));
	userData.codePostal = Number(prompt("Quel est ton code postal ?"));
	return userData;
}
const userData = askUser();