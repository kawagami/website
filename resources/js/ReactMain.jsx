import React, { Component } from 'react'
import ReactDOM from 'react-dom'
import { Route, BrowserRouter, Switch, Redirect } from 'react-router-dom'
import Index from './components/Index'
import NavBar from './components/NavBar'
import LoadingEffect from './components/LoadingEffect'
import FunctionList from './pages/FunctionList'
import ProjectList from './pages/ProjectList'
import ProjVote from './pages/ProjVote'
import ProjHardware from './pages/ProjHardware'
import ProjInvestment from './pages/ProjInvestment'
import ProjChoco from './pages/ProjChoco'
import ProjParking from './pages/ProjParking'
import ProjPayment from './pages/ProjPayment'
import Person from './pages/Person'
import Pomodoro from './pages/Pomodoro'
import Vocabulary from './pages/Vocabulary'
import StockComputer from './pages/StockComputer'
import WeatherCard from './pages/WeatherCard'
import LineBot from './pages/LineBot'
import EmailMe from './pages/EmailMe'

export default class ReactMain extends Component {

    state = {
        lodingFlag: false
    }

    render() {
        const { lodingFlag } = this.state
        return (
            <div>
                {lodingFlag && <LoadingEffect />}
                <NavBar />
                <Switch>
                    <Route path="/person" component={Person} />
                    <Route path="/function-list" component={FunctionList} />
                    <Route path="/pomodoro" component={Pomodoro} />
                    <Route path="/random-vocabulary" component={Vocabulary} />
                    <Route path="/stock-computer" component={StockComputer} />
                    <Route path="/weather-card" component={WeatherCard} />
                    <Route path="/line-bot" component={LineBot} />
                    <Route path="/project-list" component={ProjectList} />
                    <Route path="/proj-vote" component={ProjVote} />
                    <Route path="/proj-hardware" component={ProjHardware} />
                    <Route path="/proj-investment" component={ProjInvestment} />
                    <Route path="/proj-choco" component={ProjChoco} />
                    <Route path="/proj-parking" component={ProjParking} />
                    <Route path="/proj-payment" component={ProjPayment} />
                    <Route path="/email-me" component={EmailMe} />
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
