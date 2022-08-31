import React, { Component } from 'react'
import ReactDOM from 'react-dom';

export default class AddPhone extends Component {
    constructor(props) {
        super(props);

        // default value
        this.phones = [''];

        if(this.props.phones != 'null') {
            this.phones = [];

            JSON.parse(this.props.phones).map((phone) => {
                this.phones.push(phone.mobile_number);
            })
        }

        // state 
        this.state = {
            phones: this.phones,
            // phones: [''],
            errors: JSON.parse(this.props.errors) ?? []
        };

        console.log(this.props.phones);
        console.log(this.state);
        // console.log(this.props.errors);
    }

    // add accounts 
    addPhone = () => {
        let phones = this.state.phones;

        this.setState(prevState => {
            // add a new pair
            phones.push('');

            return {
                phones: phones
            };
        });
    }

    removePhone = (index) => {
        let phones = this.state.phones;

        this.setState(prevState => {
            if (index > -1) {
                phones.splice(index, 1);
            }

            return {
                phones: phones
            };
        });
    }

    textBeautify = (text) => {
        return text.replace('.', ' box ').replace('_', ' ');
    }

    render() {

        return (
            <>
                <div className="mb-3 row">
                    <div className="col-2">
                        <label htmlFor="phone" className="mt-1 form-label required">Mobile number</label>
                    </div>

                    <div className="col-10">
                        {this.state.phones.map((data, index) => (
                        <div className="row mb-3" key={index}>
                            <div className="col-4">
                                <input type="text" name="mobile_number[]" defaultValue={data ?? ""} className="form-control" id="phone" placeholder={(index === 0) ? 'Primary number' : 'Alternat number'} required />
                            </div>
                            
                            {(index === 0) ? '' : 
                            <div className="col-2">
                                <button type="button" onClick={this.removePhone.bind(this, index)} className="btn btn-danger" title="remove">
                                    <i className="bi bi-dash"></i>
                                </button>
                            </div>
                            }

                            {/* error message */}
                            <small className="text-danger">
                                { this.state.errors[index] ? this.textBeautify(this.state.errors[index].join(" ")) : '' }
                            </small>
                        </div>
                        ))}

                        {/* instruction */}
                        <small>Please type without +88.</small>

                        {/* add button */}
                        <div className="row">
                            <div className="col-4 text-end">
                                <button type="button" onClick={this.addPhone} className="btn btn-success mt-2">
                                    <span className="text-white">
                                        <span>+ </span>
                                        <span>Alternat phone number</span> 
                                    </span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </>
        )
    }
}

// DOM element
if (document.getElementById('add-phone-component')) {
    // find element by id
    const element = document.getElementById('add-phone-component');

    // create new props object with element's data-attributes
    const props = Object.assign({}, element.dataset);

    // render element with props (using spread)
    ReactDOM.render(<AddPhone {...props} />, element);
}
