import { Switch, Route } from 'react-router-dom';
import React from 'react';
import AppProvider from './context/AppProvider';
import ListUsers from './pages/ListUsers';
import FormUsers from './pages/FormUsers';
import 'bootstrap/dist/css/bootstrap.min.css';
import './App.css';

function App() {
  return (
    <AppProvider>
      <Switch>
        <Route exact path="/" component={FormUsers} />
        <Route path="/list" component={ListUsers} />
      </Switch>
    </AppProvider>
  );
}

export default App;
