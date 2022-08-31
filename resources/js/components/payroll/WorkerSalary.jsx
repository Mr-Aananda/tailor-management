import React, { Component } from 'react';
import ReactDOM from "react-dom";
import WorkerBonus from './WorkerBonus';

export default class WorkerSalary extends Component {
    constructor(props) {
        super(props);
        this.workerSalary = JSON.parse(this.props.workerSalary);
        this.cashes = JSON.parse(this.props.cashes);

        // const isNewMainEntry = !this.workerSalary;
        // console.log(isNewMainEntry);


        this.state = {
            workers: JSON.parse(this.props.workers),
            cashId: "1",
            paymentType: "cash",
            totalPayableAmount: {},
            workerId: "",
            showBonus: false,
        }

        // console.log(this.state.workers);
        // console.log(this.workerSalary);
        // console.log(this.state.workerId);
        // if (this.workerSalary.id) {
        //     this.ShowAllWorkerCostHandler(this.workerSalary.id);
        // }
    }


    componentDidMount() {
             if (this.workerSalary != "" && this.workerSalary.bonus_amount != 0) {
                 this.setState({
                     showBonus: true,

                 });
             }
    }

    ShowAllWorkerCostHandler = (worker_id) => {
        // console.log(e.target.value);
        axios
            .post(baseURL + "axios/getItemsCostbyId", {
                id: worker_id,
            })
            .then((response) => {
                this.setState({
                    totalPayableAmount: response.data,
                    workerId: worker_id,
                });
                // console.log(response.data);
            })
            .catch((reason) => {
                console.log(reason);
            });
    };

    showBonusHandler = () => {
        this.setState({
            showBonus: true,
        });
    };

    hideBonusHandler = () => {
        this.setState({
            showBonus:false,
        })
    }

    cashHandler = (e) => {
        this.setState({
            cashId: e.target.value,
        });
    };

    paymentTypeHandler = (e) => {
        this.setState({
            paymentType: e.target.value,
        });
    };

    render() {
        return (
            <>
                <div className="mb-3 row">
                    <div className="col-2">
                        <label
                            htmlFor="item-part"
                            className="mt-1 form-label required"
                        >
                            Workers
                        </label>
                    </div>

                    <div className="col-3">
                        <select
                            name="worker_id"
                            className="form-control"
                            defaultValue={this.workerSalary.worker_id}
                            onChange={(e) =>
                                this.ShowAllWorkerCostHandler(e.target.value)
                            }
                            id="worker-id"
                            required
                        >
                            <option defaultValue={""}>--</option>

                            {this.state.workers.map((worker, index) => (
                                <option value={worker.id} key={index}>
                                    {worker.worker_name}
                                </option>
                            ))}
                        </select>
                    </div>

                    <div className="col-2">
                        <div className="input-group">
                            <input
                                type="number"
                                name="worker_amount"
                                defaultValue={
                                    this.state.totalPayableAmount.total_payable
                                }
                                className="form-control"
                                id="worker-amount"
                                placeholder="0.00"
                                readOnly
                            />
                            <div className="input-group-append">
                                <span
                                    className="input-group-text"
                                    id="basic-addon2"
                                >
                                    {this.state.totalPayableAmount.status ??
                                        "$"}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <div className="mb-3 row">
                    <div className="col-2">
                        <label htmlFor="amount" className="mt-1 form-label">
                            Amount
                        </label>
                    </div>

                    <div className="col-3">
                        <div className="input-group">
                            <div className="col-4">
                                <select
                                    name="payment_type"
                                    defaultValue={this.workerSalary.paymentType}
                                    onChange={this.paymentTypeHandler}
                                    className="form-control"
                                    required
                                >
                                    <option value="cash">Cash</option>
                                </select>
                            </div>

                            <input
                                type="number"
                                name="amount"
                                defaultValue={this.workerSalary.amount}
                                className="form-control"
                                id="amount"
                                placeholder="0.00"
                            />
                        </div>
                    </div>
                    <div className="col-2">
                        <a
                            type="submit"
                            className="btn btn-sm btn-success text-decoration-none"
                            // onClick={this.showBonusHandler}
                            onClick={() => {
                                this.showBonusHandler();

                                // this.hideBonusHandler();
                            }}
                        >
                            Add Bonus
                        </a>
                    </div>
                </div>
                {/* cash select */}
                <div className="mb-3 row">
                    <div className="col-2">
                        <label
                            htmlFor="employee_id"
                            className="mt-1 form-label"
                        >
                            &nbsp;
                        </label>
                    </div>

                    <div className="col-3">
                        <select
                            name="cash_id"
                            className="form-control"
                            defaultValue={this.workerSalary.cash_id}
                            onChange={this.props.cashHandler}
                            id="cash-id"
                        >
                            {this.cashes.map((cash, index) => (
                                <option value={cash.id} key={index}>
                                    {cash.cash_name}
                                </option>
                            ))}
                        </select>
                    </div>
                </div>
                {/* cash select end */}

                <div>
                    {this.state.showBonus && (
                        <WorkerBonus
                            workers={this.state.workers}
                            workerId={this.state.workerId}
                            workerSalary={this.workerSalary}
                        />
                    )}
                </div>
            </>
        );
    }
}


// DOM element
if (document.getElementById("select-worker-show-total-payable-balance-and-deduct")) {
    // find element by id
    const element = document.getElementById("select-worker-show-total-payable-balance-and-deduct");

    // create new props object with element's data-attributes
    const props = Object.assign({}, element.dataset);

    // render element with props (using spread)
    ReactDOM.render(<WorkerSalary {...props} />, element);
}
