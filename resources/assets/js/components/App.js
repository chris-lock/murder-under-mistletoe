import React from 'react';
import {
  BrowserRouter as Router,
  Route,
} from 'react-router-dom';
import ViewMain from './views/ViewMain';
import ReactDOM from 'react-dom';

const app = document.getElementById('app');

if (app) {
  ReactDOM.render(
    (
      <Router>
        <ViewMain>
          <Route exact path="/" component={() => <h1>Home</h1>}/>
          <Route path="/about" component={() => <h1>About</h1>}/>
          <Route path="/topics" component={() => <h1>Topics</h1>}/>
        </ViewMain>
      </Router>
    ),
    app
  );
}
