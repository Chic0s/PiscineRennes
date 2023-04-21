const shop=[]

function Add(valu, price) {
    const NameOfItem = valu.id;
    const ValOfItem = valu.value;
    let res = ValOfItem * price;
    shop.push(NameOfItem, price, ValOfItem);
    console.log(shop);

    sessionStorage.setItem(NameOfItem, ValOfItem);

    console.log(NameOfItem + ' : ' + sessionStorage.getItem(NameOfItem));
}


// GENERATION DU TICKET 

function GenerateNUMBER(offer) {
    const name = offer[0] + offer[1] + offer[2];
    const Valuenum = Math.floor(Math.random() * (999999 - 100000 + 1)) + 100000;
    const NUM = name + Valuenum;
    return NUM;
}
