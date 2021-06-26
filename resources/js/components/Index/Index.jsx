import React, { Component } from 'react'
import MyNavLink from '../MyNavLink'

export default class Index extends Component {
    render() {
        return (
            <div className="container">
                <div className="row">
                    <div className="twelve columns">
                        <ul className="ca-menu">
                            <MyNavLink to="/function-list">
                                <li>
                                    <span className="ca-icon">
                                        <i class="fas fa-tools"></i>
                                    </span>
                                    <div className="ca-content">
                                        <h2 className="ca-main">
                                            小功能
                                            <br />
                                            展示頁面
                                        </h2>
                                        <h3 className="ca-sub">Across all major devices</h3>
                                    </div>
                                </li>
                            </MyNavLink>
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
                                        <h3 className="ca-sub">Full slider, boxed or none</h3>
                                    </div>
                                </li>
                            </MyNavLink>
                            <li>
                                <span className="ca-icon">
                                    <i className="fa fa-bullhorn"></i>
                                </span>
                                <div className="ca-content">
                                    <h2 className="ca-main">
                                        Friendly
                                        <br />
                                        Documentation
                                    </h2>
                                    <h3 className="ca-sub">Straight to the point</h3>
                                </div>
                            </li>
                            <li>
                                <span className="ca-icon">
                                    <i className="fa fa-camera"></i>
                                </span>
                                <div className="ca-content">
                                    <h2 className="ca-main">
                                        Filterable
                                        <br />
                                        Portofolio
                                    </h2>
                                    <h3 className="ca-sub">Isotop &amp; PrettyPhoto</h3>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        )
    }
}
