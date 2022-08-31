import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import axios from "axios";

class JournalCreate extends React.Component {
    constructor(props) {
        super(props);

        // get old data 
        this.olddata = JSON.parse(this.props.olddata);

        // state  
        this.state = {
            groups: JSON.parse(this.props.groups),
            templates: [],
            templateDetails: [],
            depreciable: false,
            selectedGroupId: this.olddata.group_id,
            selectedTemplateId: this.olddata.template_id ?? "",
            errors: JSON.parse(this.props.errors) ?? [],
        };

        // console.log(this.props);
        // console.log(this.state);
        // console.log(this.olddata);
    }

    componentDidMount() {
        // re-call methods 
        if(this.olddata.group_id != null) {
            this.getTemplates(this.olddata.group_id);
            this.getTemplateDetails(this.olddata.template_id);
            this.getDepreciable(this.olddata.depreciationYear);
        }
    }

    handleTemplates = (event) => {
        this.getTemplates(event.target.value);
    }

    getTemplates = (id) => {
        axios.post(baseURL + "axios/getTemplatesByGroupId", {
            group_id : id,
        }).then(response => {
            this.setState({
                templates: response.data
            });

            // console.log(response.data);
        }).catch(reason => {
            console.log(reason);
        });

        console.log(this.state.selectedTemplateId);
    }


    handleTemplateDetails = (event) => {
        this.setState({
            selectedTemplateId: event.target.value,
            errors: []
        });

        this.getTemplateDetails(event.target.value);
    }

    getTemplateDetails = (id) => {
        axios.post(baseURL + "axios/getTemplateDetailsByTemplateId", {
            template_id : id,
        }).then(response => {
            // update details
            this.setState({
                templateDetails: response.data
            });

            // console.log(response.data);

            // check depreciable
            this.state.templates.map((template) => {
                if(template.id === parseInt(id)) {
                    this.setState({
                        depreciable: (template.is_depreciable) ? true : false
                    });
                }
            });
        }).catch(reason => {
            console.log(reason);
        });
    }

    getDepreciable = (totalYear = null) => {
        // console.log(totalYear);

        if(totalYear) {
            this.setState({
                depreciable: true
            });
        }
    }

    textBeautify = (text) => {
        return text.replace('.', ' box ').replace('_', ' ');
    }

    render() {
        console.log(this.state.errors);

        return (
            <>
                {/* Group start */}
                <div className="mb-3 row">
                    <div className="col-2">
                        <label htmlFor="journal-group" className="mt-1 form-label required">Group</label>
                    </div>

                    <div className="col-4">
                        <select name="group_id" defaultValue={this.state.selectedGroupId} onChange={this.handleTemplates} className="form-control" id="journal-group" required>
                            <option value=""> -- </option>
                            {this.state.groups.map((group) => ( <option value={group.id} key={group.id}>{group.name}</option> ))}
                        </select>

                        {/* error message */}
                        <small className="text-danger">
                            { this.state.errors.group_id ? this.state.errors.group_id : '' }
                        </small>
                    </div>
                </div>
                {/* Group end */}

                {/* template start */}
                <div className="mb-3 row">
                    <div className="col-2">
                        <label htmlFor="template-id" className="mt-1 form-label required">Template</label>
                    </div>

                    <div className="col-5">
                        <select name="template_id" value={this.state.selectedTemplateId} onChange={this.handleTemplateDetails} className="form-control" id="template-id" required>
                            <option value=""> -- </option>
                            {this.state.templates.map((template) => ( <option value={template.id} key={template.id}>{template.particular}</option> ))}
                        </select>

                        {/* error message */}
                        <small className="text-danger">
                            { this.state.errors.template_id ? this.state.errors.template_id : '' }
                        </small>
                    </div>
                </div>
                {/* template end */}

                {/* template accounts start */}
                {(this.state.templateDetails.length > 0) ? 
                <div className="row mb-3">
                    <div className="col-2" >
                        <label className="form-label mt-1">&nbsp;</label>
                    </div>

                    <div className="col-10">
                        <div className="row">
                            <div className="col-4"><small><strong>Debit area</strong></small></div>
                            <div className="col-4"><small><strong>Credit area</strong></small></div>
                        </div>

                        {/* iteration */}
                        {this.state.templateDetails.map((details, index) => (
                            <div className="row mt-2" key={index}>
                                <div className="col-4">
                                    <input type="hidden" name="debit_account[]" value={details[0].account_id} />
                                    <input type="number" name="debit_amount[]" defaultValue={this.olddata.debit_amount[index]} step="any" min="0" className="form-control" placeholder={details[0].account.name} required />

                                    {/* error message */}
                                    <small className="text-danger">
                                        { this.state.errors.debit_amount ? this.textBeautify(this.state.errors.debit_amount[index].join(' ')) : '' }
                                    </small>
                                </div>

                                <div className="col-4">
                                    <input type="hidden" name="credit_account[]" value={details[1].account_id} />
                                    <input type="number" name="credit_amount[]" defaultValue={this.olddata.credit_amount[index]} step="any" min="0" className="form-control" placeholder={details[1].account.name} required />

                                    {/* error message */}
                                    <small className="text-danger">
                                        { this.state.errors.credit_amount ? this.textBeautify(this.state.errors.credit_amount[index].join(' ')) : '' }
                                    </small>
                                </div>
                            </div>
                        ))}
                    </div>
                </div>
                : ''}
                {/* template accounts end */}

                {/* depreciation start */}
                {(this.state.depreciable == true) ?
                <div className="mb-3 row">
                    <div className="col-2">
                        <label className="form-label mt-1 required">Depreciation</label>
                    </div>

                    <div className="col-10">
                        <div className="row">
                            <div className="col-3">
                                <input type="number" name="depreciationYear" defaultValue={this.olddata.depreciationYear} className="form-control" id="depreciation-year" placeholder="Approximate year to use" required />
                            </div>

                            <div className="col-3">
                                <input type="number" name="depreciationAmount" defaultValue={this.olddata.depreciationAmount} step="any" className="form-control" id="depreciation-amount" placeholder="Fund per year" required />
                            </div>
                        </div>
                    </div>
                </div>
                : ''}
                {/* depreciation end */}

            </>
        );
    }
}

// DOM element
if (document.getElementById('journal-create-component')) {
    // find element by id
    const element = document.getElementById('journal-create-component');

    // create new props object with element's data-attributes
    const props = Object.assign({}, element.dataset);

    // render element with props (using spread)
    ReactDOM.render(<JournalCreate {...props} />, element);
}