const insertdata = (arr, elem, pos) => {
    const retourner = [];
    let ins = false;
    for (let index = 0; index < arr.length; index++) {
        if (index == pos) {
            retourner[index] = elem;
            ins = true;
        }
        ins == true ? retourner[index + 1] = arr[index] : retourner[index] = arr[index];
    }

    return retourner;

}
