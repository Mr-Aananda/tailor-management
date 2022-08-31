import React, { Component } from 'react'


export default class WorkerBonus extends Component {
    constructor(props) {
        super(props);
        // console.log(this.props.workerId);
        console.log(this.props.workerSalary);
        // let isUpdate = this.props.workerSalary;
        // console.log(isUpdate);
        this.state = {
            formDate: "",
            toDate: "",
            bonusPerchantage: 0,
            bounsAmount: 0,
            totalDistributeAmount: {},
        };

        // if (jodi_edit_korte_chai) {
        //     // state a propt theke formDate & toDate set korben
        //     this.SendDataForWorkerBonus()
        // }
    }

    componentDidMount() {
        if (this.props.workerSalary != "") {
            this.SendDataForWorkerBonus();
        }

    }


    getFromDateHandler = (e) => {
        this.setState({
            formDate: e.target.value,
        });
    };
    getToDateHandler = (e) => {
        this.setState({
            toDate: e.target.value,
        });
    };

    bonusPercentageHandler = (e) => {
        this.setState(
            {
                bonusPerchantage: e.target.value,
            },
            this.getBonusAmount
        );
        // console.log(this.state.bonusPerchantage);
    };

    bonusAmountHandler = (e) => {
        this.setState({
            bounsAmount:e.target.value,
        });
    }

    getBonusAmount = () => {
        let bonusPerchantage = this.state.bonusPerchantage || 0;

        bonusPerchantage =
            (this.state.totalDistributeAmount.total_distribute_amount *
                bonusPerchantage) /
            100;

        this.setState({
            bounsAmount: bonusPerchantage,
        });
    };

    SendDataForWorkerBonus = () => {
        axios
          .post(baseURL + "axios/getDistributeCompleteData", {
            worker_id:
              this.props.workerSalary != ""
                ? this.props.workerSalary.worker_id
                : this.props.workerId,
            formDate:
              this.props.workerSalary != ""
                ? this.props.workerSalary.form_date
                : this.state.formDate,
            toDate:
              this.props.workerSalary != ""
                ? this.props.workerSalary.to_date
                : this.state.toDate,

            // worker_id: this.props.workerId,
            // formDate: this.state.formDate,
            // toDate: this.state.toDate,
          })
          .then((response) => {
            this.setState({
              totalDistributeAmount: response.data,
            });
            console.log(response.data);
          })
          .catch((reason) => {
            console.log(reason);
          });
    };

    render() {
        return (
            <>
                <div className="mb-3">
                    <div className="row">
                        <div className="col-2">&nbsp;</div>
                        <div className="col-2">
                            <label htmlFor="date" className="form-label">
                                Date (From)
                            </label>
                            <input
                                defaultValue={this.props.workerSalary.form_date}
                                onChange={(e) => this.getFromDateHandler(e)}
                                type="date"
                                id="formdate"
                                name="form_date"
                                className="form-control"
                                placeholder="YYYY-MM-DD"
                            />
                        </div>
                        <div className="col-2">
                            <label htmlFor="date" className="form-label">
                                Date (To)
                            </label>
                            <input
                                defaultValue={this.props.workerSalary.to_date}
                                onChange={(e) => this.getToDateHandler(e)}
                                type="date"
                                id="todate"
                                name="to_date"
                                className="form-control"
                                placeholder="YYYY-MM-DD"
                            />
                        </div>
                        <div className="col-2">
                            <label className="form-label">&nbsp;</label>
                            <a
                                className="btn w-75 btn-success mt-4 text-decoration-none"
                                onClick={(e) => this.SendDataForWorkerBonus(e)}
                            >
                                <i className="bi bi-search"></i>
                                <span className="p-1">Search</span>
                            </a>
                        </div>
                    </div>

                    <div className="row mb-3">
                        <div className="col-2">&nbsp;</div>
                        <div className="col-2">
                            <label
                                htmlFor="total-amount"
                                className="mt-1 form-label "
                            >
                                Total amount
                            </label>
                            <input
                                type="number"
                                name="total_amount"
                                defaultValue={
                                    this.state.totalDistributeAmount
                                        .total_distribute_amount
                                }
                                className="form-control"
                                id="total-amount"
                                placeholder="0.00"
                                readOnly
                            />
                        </div>

                        <div className="col-2">
                            <label htmlFor="bonus" className="mt-1 form-label ">
                                Bonus(%)
                            </label>
                            <input
                                type="number"
                                name="bonus"
                                defaultValue={this.props.workerSalary.bonus}
                                onChange={this.bonusPercentageHandler}
                                // onChange={(e) =>
                                //     this.bonusPercentageHandler(e.target.value)
                                // }
                                className="form-control"
                                id="bonus"
                                placeholder="0.00"
                            />
                        </div>

                        <div className="col-2">
                            <label
                                htmlFor="bonus-amount"
                                className="mt-1 form-label "
                            >
                                Bonus amount
                            </label>
                            <input
                                type="number"
                                name="bonus_amount"
                                onChange={this.bonusAmountHandler}
                                value={this.state.bounsAmount}
                                // defaultValue={
                                //     this.props.workerSalary.bonus_amount
                                // }
                                className="form-control"
                                id="bonus_amount"
                                placeholder="0.00"
                            />
                        </div>
                    </div>
                </div>
            </>
        );
    }
}
