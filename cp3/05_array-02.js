const t2 = [1,2,3,4];
const multiplierChaqueCellule = (t2) => {
	const t3 = [];
	for (let i = 0; i < t2.length; i++) {
		t3.push(t2[i] * 2);
	}
	console.log(t3);
}
multiplierChaqueCellule(t2);