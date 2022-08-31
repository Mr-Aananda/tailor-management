import React, { Component } from 'react';
import ReactDOM from 'react-dom';

class TemplateEdit extends React.Component {
    constructor(props) {
        super(props);

        // get response 
        this.accounts = JSON.parse(this.props.accounts);

        // state 
        this.state = {
            accounts: JSON.parse(this.props.details)
        };

        console.log(this.state.accounts);
    }

    // add accounts 
    addAccount = () => {
        let allAccounts = this.state.accounts;

        this.setState(prevState => {
            // add a new pair
            allAccounts.push([{}, {}]);

            return {
                accounts: allAccounts
            };
        });
    }

    // remove account
    removeAccount = (index) => {
        let allAccounts = this.state.accounts;

        this.setState(prevState => {
            if (index > -1) {
                allAccounts.splice(index, 1);
            }

            return {
                accounts: allAccounts
            };
        });
    }

    render() {
        return (
            <>
                <div className="row mb-3">
                    <div className="col-2" >
                        <label className="form-label required mt-1">Add accounts</label>
                    </div>

                    <div className="col-10">
                        {this.state.accounts.map((data, index) => (
                        <div className="row" key={index}>
                            <div className="col-3 mt-2">
                                <select name="debit_accounts[]" defaultValue={data[0].account_id ?? ""} className="form-control" required>
                                    <option value="" disabled>-- Debit account --</option>
                                    {this.accounts.map((account) => ( <option value={account.id} key={account.id}>{account.name}</option> ))}
                                </select>
                            </div>

                            <div className="col-3 mt-2">
                                <select name="credit_accounts[]" defaultValue={data[1].account_id ?? ""} className="form-control" required>
                                    <option value="" disabled>-- Credit account --</option>
                                    {this.accounts.map((account) => ( <option value={account.id} key={account.id}>{account.name}</option> ))}
                                </select>
                            </div>

                            {(index === 0) ? '' :
                            <div className="col-2 mt-2">
                                <button type="button" onClick={this.removeAccount.bind(this, index)} className="btn btn-danger" title="remove">
                                    <i className="bi bi-dash"></i>
                                </button>
                            </div>
                            }
                        </div>
                        ))}

                        <div className="row">
                            <div className="col-6 mt-2 text-end">
                                <button type="button" onClick={this.addAccount} className="btn btn-success">
                                    <span className="text-white">
                                        <span>+ </span>
                                        <span>Account</span> 
                                    </span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </>
        );
    }
}

// DOM element
if (document.getElementById('template-edit-component')) {
    // find element by id
    const element = document.getElementById('template-edit-component');

    // create new props object with element's data-attributes
    const props = Object.assign({}, element.dataset);

    // render element with props (using spread)
    ReactDOM.render(<TemplateEdit {...props} />, element);
}