import React from 'react';
import ReactDOM from 'react-dom';
import App from './stateful-calculator/app.js';
import registerServiceWorker from './stateful-calculator/registerServiceWorker';

ReactDOM.render(<App />, document.getElementById('root'));
registerServiceWorker();
