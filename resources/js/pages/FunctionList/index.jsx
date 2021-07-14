import React, { Component } from 'react'
import Section from '../../components/Section'
import MyNavLink from '../../components/MyNavLink'

export default class FunctionList extends Component {

    state = {
        functionPages: [
            { to: "/pomodoro", title: "番茄鐘", icon: "far fa-clock" },
            { to: "/stock-computer", title: "股票計算機", icon: "fas fa-chart-line" },
            { to: "/weather-card", title: "天氣卡片", icon: "fas fa-cloud-sun-rain" },
            { to: "/random-vocabulary", title: "隨機英文單字", icon: "fas fa-book-open" },
            { to: "/line-bot", title: "Line Bot", icon: "fas fa-robot" }
        ]
    }

    render() {
        const { functionPages } = this.state
        return (
            <div className="inner-container">
                <ul>
                    {
                        functionPages.map((page) => {
                            return (
                                <li>
                                    <MyNavLink to={page.to}>
                                        <Section title={page.title} icon={page.icon} />
                                    </MyNavLink>
                                </li>
                            )
                        })
                    }
                </ul>
            </div>
        )
    }
}
