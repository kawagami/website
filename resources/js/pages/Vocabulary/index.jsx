import Axios from 'axios'
import React, { Component } from 'react'
import UndonePage from '../UndonePage'

export default class Vocabulary extends Component {

    state = {
        vocabulariesArray: [
            { class: "vocabulary1", vocabulary: "", explain: "" },
            { class: "vocabulary2", vocabulary: "", explain: "" },
            { class: "vocabulary3", vocabulary: "", explain: "" },
            { class: "vocabulary4", vocabulary: "", explain: "" },
            { class: "vocabulary5", vocabulary: "", explain: "" },
            { class: "vocabulary6", vocabulary: "", explain: "" },
            { class: "vocabulary7", vocabulary: "", explain: "" },
            { class: "vocabulary8", vocabulary: "", explain: "" },
            { class: "vocabulary9", vocabulary: "", explain: "" },
            { class: "vocabulary10", vocabulary: "", explain: "" },
        ]
    }

    getNewVocabularies = () => {
        const url = "/api/random-vocabulary"
        const { vocabulariesArray } = this.state

        Axios.post(url).then(
            response => {
                return response.data ?? response.result ?? []
                // console.log(response.result);
                // const crawlerArray = response.json()
                // console.log(crawlerArray);
                // //获取状态中的todos
                // const { vocabulariesArray } = this.state
                // //匹配处理数据
                // // console.log(response.data);
                // const newVocabulariesArray = vocabulariesArray.map((item) => {
                //     return { ...item, vocabulary, explain }
                // })
                // this.setState({ vocabulariesArray: newVocabulariesArray })
            },
            error => {
                console.log(error)
            }
        ).then(second => {
            const { vocabulariesArray } = this.state
            let newArray = vocabulariesArray;
            for (let times = 0; times < second.length; times++) {
                newArray[times]['vocabulary'] = second[times]['vocabulary']
                newArray[times]['explain'] = second[times]['explain']
                // console.log(newArray[times]['vocabulary'])
                // console.log(second[times]['vocabulary'])
                // console.log('');
                // console.log(newArray[times]['explain'])
                // console.log(second[times]['explain'])
                // console.log('');
            }
            this.setState({ vocabulariesArray: newArray })
        })
    }

    render() {
        const { vocabulariesArray } = this.state
        return (
            <div className="vocabulary-container">
                {
                    vocabulariesArray.map((vocabulary, index) => {
                        return (
                            <div key={index} className={vocabulary.class}>
                                <div className="vocabulary-section">{vocabulary.vocabulary}</div>
                                <div className="explain-section">{vocabulary.explain}</div>
                            </div>
                        )
                    })
                }
                <div className="new-vocabulary">
                    <button className="smoothXY" onClick={this.getNewVocabularies}>取得新單字</button>
                </div>
            </div>
        )
    }
}
