import Axios from 'axios'
import React, { Component } from 'react'
import UndonePage from '../UndonePage'

export default class Vocabulary extends Component {

    state = {
        vocabulariesArray: [
            { class: "vocabulary1", vocabulary: "vocabulary1 vocabulary", explain: "vocabulary1 explain" },
            { class: "vocabulary2", vocabulary: "vocabulary2 vocabulary", explain: "vocabulary2 explain" },
            { class: "vocabulary3", vocabulary: "vocabulary3 vocabulary", explain: "vocabulary3 explain" },
            { class: "vocabulary4", vocabulary: "vocabulary4 vocabulary", explain: "vocabulary4 explain" },
            { class: "vocabulary5", vocabulary: "vocabulary5 vocabulary", explain: "vocabulary5 explain" },
            { class: "vocabulary6", vocabulary: "vocabulary6 vocabulary", explain: "vocabulary6 explain" },
            { class: "vocabulary7", vocabulary: "vocabulary7 vocabulary", explain: "vocabulary7 explain" },
            { class: "vocabulary8", vocabulary: "vocabulary8 vocabulary", explain: "vocabulary8 explain" },
            { class: "vocabulary9", vocabulary: "vocabulary9 vocabulary", explain: "vocabulary9 explain" },
            { class: "vocabulary10", vocabulary: "vocabulary10 vocabulary", explain: "vocabulary10 explain" },
        ]
    }

    getNewVocabularies = () => {
        const url = "/api/random-vocabulary"
        const { vocabulariesArray } = this.state

        Axios.post(url).then(
            response => {
                return response.data
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
