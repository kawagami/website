import React, { Component } from 'react'
import MyNavLink from '../MyNavLink'

export default class Index extends Component {
    render() {
        return (
            <div className="container">
                <div className="row">
                    <div className="twelve columns">
                        <ul className="ca-menu">
                            <MyNavLink to="/person">
                                <li>
                                    <span className="ca-icon">
                                        <i className="fa fa-user"></i>
                                    </span>
                                    <div className="ca-content">
                                        <h2 className="ca-main">
                                            個人資料
                                            <br />
                                            瀏覽頁
                                        </h2>
                                        <h3 className="ca-sub">Survival of the fittest</h3>
                                    </div>
                                </li>
                            </MyNavLink>
                            <MyNavLink to="/function-list">
                                <li>
                                    <span className="ca-icon">
                                        <i className="fas fa-tools"></i>
                                    </span>
                                    <div className="ca-content">
                                        <h2 className="ca-main">
                                            小功能
                                            <br />
                                            展示頁面
                                        </h2>
                                        <h3 className="ca-sub">Challenge Everything</h3>
                                    </div>
                                </li>
                            </MyNavLink>
                            <MyNavLink to="/project-list">
                                <li>
                                    <span className="ca-icon">
                                        <i className="fas fa-briefcase"></i>
                                    </span>
                                    <div className="ca-content">
                                        <h2 className="ca-main">
                                            經歷專案
                                            <br />
                                            列表
                                        </h2>
                                        <h3 className="ca-sub">Think Different</h3>
                                    </div>
                                </li>
                            </MyNavLink>
                            <MyNavLink to="/email-me">
                                <li>
                                    <span className="ca-icon">
                                        <i className="fas fa-envelope"></i>
                                    </span>
                                    <div className="ca-content">
                                        <h2 className="ca-main">
                                            電子郵件
                                            <br />
                                            連絡我
                                        </h2>
                                        <h3 className="ca-sub">Live Better</h3>
                                    </div>
                                </li>
                            </MyNavLink>
                        </ul>
                    </div>
                </div>
            </div>
        )
    }
}
