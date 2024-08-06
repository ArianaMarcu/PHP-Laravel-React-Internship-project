console.log('App.js is running');

/// JSX -JavaScript XML

/* function getLocation(location){
    if(location){
        return <p>Location: {location}</p>;
    } else {
        return undefined;
    }
}

var user = {
    name: 'Ari',
    age: 22,
    location: 'Aiud'
};

var templateTwo = (
    <div>
      <h1>{user.name ? user.name : 'Anonymous'}</h1> 
      {user.age && user.age >= 18 && <p>Age: {user.age}</p>}
      {getLocation(user.location)}
    </div>
  ); */

let count = 0;
const addOne = () => {
    count++;
    renderCounterApp();
}; 
const minusOne = () => {
    count--;
    renderCounterApp();
}; 
const reset = () => {
    count = 0;
    renderCounterApp();
}; 

var appRoot = document.getElementById('app');

const renderCounterApp = () => {
    const templateTwo = (
        <div>
            <h1>Count: {count}</h1>
            <button onClick={addOne}>+1</button>
            <button onClick={minusOne}>-1</button>
            <button onClick={reset}>reset</button>
        </div>
    );
    ReactDOM.render(templateTwo, appRoot);
};

renderCounterApp();