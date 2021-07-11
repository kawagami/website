import React, { Component } from 'react'
import Section from '../Section'
import MyNavLink from '../../components/MyNavLink'

export default class FunctionList extends Component {
    render() {
        return (
            <div className="inner-container">
                <ul>
                    <MyNavLink to="/pomodoro">
                        <li>
                            <Section title="番茄鐘" icon="far fa-clock" />
                        </li>
                    </MyNavLink>
                    <MyNavLink to="/stock-computer">
                        <li>
                            <Section title="股票計算機" icon="fas fa-chart-line" />
                        </li>
                    </MyNavLink>
                    <MyNavLink to="/weather-card">
                        <li>
                            <Section title="天氣卡片" icon="fas fa-cloud-sun-rain" />
                        </li>
                    </MyNavLink>
                    <MyNavLink to="/random-vocabulary">
                        <li>
                            <Section title="隨機英文單字" icon="fas fa-book-open" />
                        </li>
                    </MyNavLink>
                    <MyNavLink to="/line-bot">
                        <li>
                            <Section title="Line Bot" icon="fas fa-robot" />
                        </li>
                    </MyNavLink>
                    <li>
                    </li>
                    <li>
                    </li>
                    <li>
                    </li>
                </ul>
            </div>
        )
    }
}
