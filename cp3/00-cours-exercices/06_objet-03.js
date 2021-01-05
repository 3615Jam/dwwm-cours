function verifierParamPrecedent(...n) {
	for (let elem of n) {
		if (Number.isInteger(n[n.length-1] / n[0])) {
			return 'true'; 
		}
	return 'false';
	}
}

verifierParamPrecedent(2,8,20); 