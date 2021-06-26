import React, { Component } from 'react'
import ReactDOM from 'react-dom'
import { Route, BrowserRouter, Switch, Redirect } from 'react-router-dom'
import Index from './components/Index'
import NavBar from './components/NavBar'
import FunctionList from './pages/FunctionList'
import Person from './pages/Person'

export default class ReactMain extends Component {

    render() {
        return (
            <div>
                <NavBar />
                <Switch>
                    <Route path="/function-list" component={FunctionList} />
                    <Route path="/person" component={Person} />
                    <Route path="/" component={Index} />
                    <Redirect to="/" />
                </Switch>
            </div>
        )
    }
}

if (document.getElementById('react-main')) {
    ReactDOM.render(
        <BrowserRouter>
            <ReactMain />
        </BrowserRouter>
        , document.getElementById('react-main'))
}
