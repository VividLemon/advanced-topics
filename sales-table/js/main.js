
// The following is a record of sales for a small business... 

var sales = [
	{customer:"Peter", product: "microwave", date:"07-20-2019", price: 39.99},
	{customer:"Bob", product: "bike", date:"12-20-2020", price: 349.99},
	{customer:"Bob", product: "tv", date:"12-20-2020", price: 199.99},
	{customer:"Bob", product: "radio", date:"12-4-2020", price: 19.99},
	{customer:"Sally", product: "lamp", date:"12-15-2020", price: 199.99},
	{customer:"Sally", product: "guitar", date:"12-16-2020", price: 299.99},
	{customer:"Gus", product: "shirt", date:"12-17-2020", price: 599.99},
	{customer:"Gus", product: "baking pan", date:"12-13-2020", price: 19.99}
];





/*
Implement code for the displayTable function.
The parameter should be an array of 'sales' objects (like the one above).
The function should display a table inside the DIV element on the page.
The table should look like the one in the image.
*/
function displayTable(arSales = sales){

    

	// Put your code here
	//#table-container
	const div = document.getElementById(`table-container`);
    if(div.hasChildNodes()){
        div.removeChild(div.firstChild);
    }


	const table = document.createElement("table");
	div.appendChild(table);
	const head = table.createTHead();
	const row = head.insertRow();

    array = sortObjects(arSales);

	for(let key of Object.keys(arSales[0])){
		const th = document.createElement("th");
		const text = document.createTextNode(key);
		th.appendChild(text);
		row.appendChild(th);
	}


	array.forEach(object => {
		let row = table.insertRow();
		for (const key in object) {
			if (Object.hasOwnProperty.call(object, key)) {
				const element = object[key];
				let cell = row.insertCell();
				let textNode = document.createTextNode(element);
				cell.appendChild(textNode);

			}
		}
	});

}

function sortObjects(arr){
    const select = document.querySelector(".sort");
    const value = select.value;
    if(value == "price"){
        arr.sort((a,b) => {
            return b.price - a.price;
        });
    }else if(value == "customer"){
        arr.sort((a,b) => {
            let fa = a.customer.toLowerCase(),
            fb = b.customer.toLowerCase();

            if(fa < fb){
                return -1;
            }
            if(fa > fb){
                return 1;
            }
            return 0
        });
    }else if(value == "product"){
        arr.sort((a,b) => {
            let fa = a.product.toLowerCase(),
            fb = b.product.toLowerCase();

            if(fa < fb){
                return -1;
            }
            if(fa > fb){
                return 1;
            }
            return 0
        });
    }else{
        arr.sort((a,b) => {
            let da = new Date(a.date),
            db = new Date(b.date);
            return db - da;
        });
    }
    return arr;
}

displayTable();


