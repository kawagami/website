import React, { Component } from 'react'
import ReactDOM from 'react-dom'
import Axios from 'axios'

export default class ReactMain extends Component {

    // state = {
    //     pages: [
    //         { id: 1, name: '頁面1', oldFlag: false, pageContent: 'pageContent1' }
    //     ]
    // }

    componentDidMount() {
        // $('li').on('click', (e)=>{console.log(123);})
    }

    render() {
        return (
            <div className="container">
                <div className="row">
                    <div className="twelve columns">
                        <ul className="ca-menu">
                            <li>
                                <span className="ca-icon">
                                    <i className="fa fa-heart"></i>
                                </span>
                                <div className="ca-content">
                                    <h2 className="ca-main">
                                        Responsive
                                        <br />
                                        Design
                                    </h2>
                                    <h3 className="ca-sub">Across all major devices</h3>
                                </div>
                            </li>
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
                                    <i className="fa fa-user"></i>
                                </span>
                                <div className="ca-content">
                                    <h2 className="ca-main">
                                        Alternate
                                        <br />
                                        Home Pages
                                    </h2>
                                    <h3 className="ca-sub">Full slider, boxed or none</h3>
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

if (document.getElementById('react-main')) {
    ReactDOM.render(<ReactMain />, document.getElementById('react-main'))
}
