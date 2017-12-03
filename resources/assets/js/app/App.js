import React from 'react';
import ReactDOM from 'react-dom';
import {
  BrowserRouter,
  Switch,
  Route,
} from 'react-router-dom';
import GameView from './components/views/game/GameView';
import ConclusionView from './components/views/conclusion/ConclusionView';

const app = document.getElementById('app');

if (app) {
  ReactDOM.render(
    (
      <BrowserRouter>
        <Switch>
          <Route path="/conclusion" component={ConclusionView} />
          <Route path="/" component={GameView} />
        </Switch>
      </BrowserRouter>
    ),
    app
  );
}
