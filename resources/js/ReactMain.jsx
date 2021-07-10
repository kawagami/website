import React, { Component } from 'react'
import ReactDOM from 'react-dom'
import { Route, BrowserRouter, Switch, Redirect } from 'react-router-dom'
import Index from './components/Index'
import NavBar from './components/NavBar'
import FunctionList from './pages/FunctionList'
import Person from './pages/Person'
import Pomodoro from './pages/Pomodoro'
import Vocabulary from './pages/Vocabulary'
import StockComputer from './pages/StockComputer'
import WeatherCard from './pages/WeatherCard'

export default class ReactMain extends Component {

    render() {
        return (
            <div>
                <NavBar />
                <Switch>
                    <Route path="/function-list" component={FunctionList} />
                    <Route path="/person" component={Person} />
                    <Route path="/pomodoro" component={Pomodoro} />
                    <Route path="/random-vocabulary" component={Vocabulary} />
                    <Route path="/stock-computer" component={StockComputer} />
                    <Route path="/weather-card" component={WeatherCard} />
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
