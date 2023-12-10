let openShopping = document.querySelector('.shopping');
let closeShopping = document.querySelector('.closeShopping');
let list = document.querySelector('.list');
let listCard = document.querySelector('.listCard');
let body = document.querySelector('body');
let total = document.querySelector('.total');
let quantity = document.querySelector('.quantity');

openShopping.addEventListener('click', ()=>{
    body.classList.add('active');
})
closeShopping.addEventListener('click', ()=>{
    body.classList.remove('active');
})

let products = [
    { name: ' The Legend of Zelda: Breath of the Wild', category: 'adventure', price: 45.99, image: 'game1.jpg', compatibility:' nintendo switch',stockLevel: '7'},
    { name: 'Cities: Skylines', category: 'simulation', price: 39.99, image: 'cities.jpg',compatibility:'multiple platforms',stockLevel: '15' },
    { name: 'EA Sports FC24', category: 'sports', price: 49.99, image: 'fifa.jpeg', compatibility:'multiple platforms' ,stockLevel: '5'},
    { name: 'Mario Kart 8 Deluxe', category: 'sports', price: 50.99, image: 'mario.jpeg', compatibility:'nintendo switch', stockLevel: '15'  },
    { name: 'Uncharted 4: A Thiefs End', category: 'adventure', price: 39.99, image: 'game3.jpg' , compatibility:'playstation',stockLevel: '15' },
    { name: 'Ticket to Ride', category: 'board', price: 25.99, image: 'ticket_to_ride.jpg',compatibility:'multiple platforms',stockLevel: '15'  },
    { name: 'NBA 2K24', category: 'sports', price: 40.99, image: 'nba2k24.png', compatibility:'playstation' ,stockLevel: '10' },
    { name: 'Splendor', category: 'board', price: 24.99, image: 'game8.jpg.webp', compatibility:'multiple platforms' ,stockLevel: '15' },
    { name: 'Firewatch', category: 'adventure', price: 24.99, image: 'firewatch.webp',compatibility:'multiple platforms',stockLevel: '15'  },
    { name: 'Carcassonne', category: 'board', price: 35.99, image: 'game9.jpg', compatibility:'multiple platforms ',stockLevel: '15' },
    { name: 'Pandemic: The Board Game', category: 'board', price: 44.99, image: 'game10.jpg',compatibility:'multiple platforms',stockLevel: '9'  },
    { name: 'Journey', category: 'adventure', price: 19.99, image: 'game2.avif',compatibility:'playstation',stockLevel: '15'  },
    { name: 'Tetris Effect', category: 'puzzle', price: 19.99, image: 'tetris.jpg', compatibility:'multiple platforms',stockLevel: '15'  },
    { name: 'Portal 2', category: 'puzzle', price: 35.99, image: 'portal.jpeg' ,compatibility:'XBox',stockLevel: '15' },
    { name: 'Catan Universe', category: 'board', price: 35.99, image: 'Catan_Universe.jpg',compatibility:'multiple platforms',stockLevel: '15'  },
    { name: 'The Witness', category: 'puzzle', price: 29.99, image: 'witness.png' ,compatibility:'multiple platforms',stockLevel: '15' },
    { name: 'Shadow of the Colossus', category: 'adventure', price: 29.99, image: 'game5.jpg' ,compatibility:'playstation',stockLevel: '15' },
    { name: 'Baba is You', category: 'puzzle', price: 22.99, image: 'baba.jpg' ,compatibility:'multiple platforms',stockLevel: '5' },
    { name: 'The Sims 4', category: 'simulation', price: 49.99, image: 'thesims.jpg',compatibility:'multiple platforms',stockLevel: '15'  },
    { name: 'Monument Valley', category: 'puzzle', price:11.99, image: 'monument.jpg',compatibility:'multiple platforms' ,stockLevel: '15' },
    { name: 'Microsoft Flight Simulator', category: 'simulation', price: 59.99, image: 'flight.jpeg',compatibility:'PC, XBox',stockLevel: '15'  },
    { name: 'Stellaris', category: 'simulation', price: 39.99, image: 'stellaris.png',compatibility:'playstation',stockLevel: '15'  },
    { name: 'Rocket League', category: 'sports', price: 29.99, image: 'rocket.jpeg',compatibility:'playstation',stockLevel: '15'  },
    { name: 'Wii Sports', category: 'sports', price: 19.99, image: 'wii.jpeg',compatibility:'nintendo switch',stockLevel: '0'  },
    { name: 'Planet Zoo', category: 'simulation', price: 15.99, image: 'zoo.jpeg',compatibility:'multiple platforms',stockLevel: '15'  },
];
let listCards  = [];
function initApp(){
    products.forEach((value, key) =>{
        let newDiv = document.createElement('div');
        newDiv.classList.add('item');
        newDiv.innerHTML = `
            <img src="image/${value.image}">
            <div class="name">${value.name}</div>
            <div class="price">${value.price.toLocaleString()}</div>
            <button onclick="addToCard(${key})">Add To Card</button>`;
        list.appendChild(newDiv);
    })
}
initApp();
function addToCard(key){
    if(listCards[key] == null){
        // copy product form list to list card
        listCards[key] = JSON.parse(JSON.stringify(products[key]));
        listCards[key].quantity = 1;
    }
    reloadCard();
}
function reloadCard(){
    listCard.innerHTML = '';
    let count = 0;
    let totalPrice = 0;
    listCards.forEach((value, key)=>{
        totalPrice = totalPrice + value.price;
        count = count + value.quantity;
        if(value != null){
            let newDiv = document.createElement('li');
            newDiv.innerHTML = `
                <div><img src="image/${value.image}"/></div>
                <div>${value.name}</div>
                <div>${value.price.toLocaleString()}</div>
                <div>
                    <button onclick="changeQuantity(${key}, ${value.quantity - 1})">-</button>
                    <div class="count">${value.quantity}</div>
                    <button onclick="changeQuantity(${key}, ${value.quantity + 1})">+</button>
                </div>`;
                listCard.appendChild(newDiv);
        }
    })
    total.innerText = totalPrice.toLocaleString();
    quantity.innerText = count;
}
function changeQuantity(key, quantity){
    if(quantity == 0){
        delete listCards[key];
    }else{
        listCards[key].quantity = quantity;
        listCards[key].price = quantity * products[key].price;
    }
    reloadCard();
}