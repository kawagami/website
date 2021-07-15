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
        ],
        emptyVocabulariesArray: [
            { class: "vocabulary1", vocabulary: "", explain: "" },
            { class: "vocabulary2", vocabulary: "", explain: "" },
            { class: "vocabulary3", vocabulary: "", explain: "" },
            { class: "vocabulary4", vocabulary: "", explain: "" },
            { class: "vocabulary5", vocabulary: "", explain: "" },
            { class: "vocabulary6", vocabulary: "", explain: "" },
            { class: "vocabulary7", vocabulary: "", explain: "" },
            { class: "vocabulary8", vocabulary: "API秀逗", explain: "" },
            { class: "vocabulary9", vocabulary: "", explain: "" },
            { class: "vocabulary10", vocabulary: "", explain: "" },
        ],
    }

    getNewVocabularies = () => {
        const url = "/api/random-vocabulary"
        Axios.post(url).then(
            response => {
                if (response.data.length && response.data.length > 0) {
                    const { vocabulariesArray } = this.state
                    let newArray = vocabulariesArray;
                    for (let times = 0; times < response.data.length; times++) {
                        newArray[times]['vocabulary'] = response.data[times]['vocabulary']
                        newArray[times]['explain'] = response.data[times]['explain']
                    }
                    this.setState({ vocabulariesArray: newArray })
                } else {
                    const { emptyVocabulariesArray } = this.state
                    this.setState({ vocabulariesArray: emptyVocabulariesArray })
                }
            },
            error => {
                console.log(error)
            }
        )
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
                                <div className="explain-section">
                                    <span>
                                        {vocabulary.explain}
                                    </span>
                                </div>
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
