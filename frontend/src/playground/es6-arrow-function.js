/* const square = function(x){
    return x*x;
}

/* const squareArrow = (x) =>{
    return x*x;
}

const squareArrow = (x) => x*x;

console.log(squareArrow(9)); */

const add = function(a,b){
    console.log(arguments);
    return a+b;
}
console.log(add(55,1));

const user = {
    name: 'Andrew',
    cities: ['Philadelphia', 'New York', 'Dublin'],
    printPlacesLived(){
        return this.cities.map((city) => this.name + ' has lived in ' + city);
    }
};
console.log(user.printPlacesLived());