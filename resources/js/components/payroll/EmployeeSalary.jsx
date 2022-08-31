import React, { Component } from 'react'
import ReactDOM from "react-dom";

export default class EmployeeSalary extends Component {
    constructor(props) {
        super(props);

        this.employeeSalary = JSON.parse(this.props.employeeSalary);
        this.cashes = JSON.parse(this.props.cashes);
        console.log(this.employeeSalary);

        this.state = {
            records: JSON.parse(this.props.records),
            currentEmployeeDetails: {},
            selectedEmployeeId: "",
            cashId: "1",
            paymentType: "cash",
            errors: JSON.parse(this.props.errors) ?? [],
            // installment: 0,
        };

        if (this.props.selectedEmployeeId) {
            this.getEmployeeDetailsHandler(this.props.selectedEmployeeId);
        }

        // console.log(this.state.employees);
        // console.log(this.props);
    }

    getEmployeeDetailsHandler = (employee_id) => {
        axios
            .post(baseURL + "axios/getEmployeeDetailsbyId", {
                id: employee_id,
            })
            .then((response) => {
                this.setState({
                    currentEmployeeDetails: response.data,
                });
                console.log(response.data);
            })
            .catch((reason) => {
                console.log(reason);
            });
    };

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
                {/* select employee start */}
                <div className="mb-3 row">
                    <div className="col-2">
                        <label
                            htmlFor="employee_id"
                            className="mt-1 form-label required"
                        >
                            Select employee
                        </label>
                    </div>

                    <div className="col-4">
                        <select
                            name="employee_id"
                            className="form-control"
                            defaultValue={this.props.selectedEmployeeId}
                            onChange={(e) =>
                                this.getEmployeeDetailsHandler(e.target.value)
                            }
                            id="employee_id"
                            required
                        >
                            <option defaultValue={""}>---</option>
                            {this.state.records.employees.map(
                                (employee, index) => (
                                    <option value={employee.id} key={index}>
                                        {employee.employee_name}
                                    </option>
                                )
                            )}
                        </select>
                        {/* error message */}
                        <small className="text-danger">
                            {this.state.errors.employee_id
                                ? this.state.errors.employee_id
                                : ""}
                        </small>
                    </div>
                </div>
                {/* select employee end  */}

                {/* Salary month start */}
                <div className="mb-3 row">
                    <div className="col-2">
                        <label
                            htmlFor="month"
                            className="mt-1 form-label required"
                        >
                            Salary of
                        </label>
                    </div>

                    <div className="col-4">
                        <input
                            type="month"
                            name="salary_month"
                            defaultValue={""}
                            className="form-control"
                            id="month"
                            required
                        />
                        {/* error message */}
                        <small className="text-danger">
                            {this.state.errors.salary_month
                                ? this.state.errors.salary_month
                                : ""}
                        </small>
                    </div>
                </div>
                {/* Salary month end  */}

                {/* Salary date start  */}
                <div className="mb-3 row">
                    <div className="col-2">
                        <label
                            htmlFor="date"
                            className="mt-1 form-label required"
                        >
                            Given date
                        </label>
                    </div>

                    <div className="col-4">
                        <input
                            type="date"
                            name="given_date"
                            defaultValue={""}
                            className="form-control"
                            id="date"
                            required
                        />
                        {/* error message */}
                        <small className="text-danger">
                            {this.state.errors.given_date
                                ? this.state.errors.given_date
                                : ""}
                        </small>
                    </div>
                </div>
                {/* Salary date end */}

                {/* Basic salary start */}
                <div className="mb-3 row">
                    <div className="col-2 ">
                        <label
                            htmlFor="basic-salary"
                            className="mt-1 form-label"
                        >
                            Basic Salary
                        </label>
                    </div>
                    <div className="col-3">
                        <div className="input-group">
                            <div className="col-4">
                                <select
                                    name="payment_type"
                                    defaultValue={""}
                                    onChange={this.props.paymentTypeHandler}
                                    className="form-control"
                                    required
                                >
                                    <option value="cash">Cash</option>
                                </select>
                            </div>
                            <input
                                type="number"
                                name="basic_salary"
                                defaultValue={
                                    this.state.currentEmployeeDetails
                                        .basic_salary
                                }
                                className="form-control"
                                id="basic-salary"
                                placeholder="0.00"
                            />
                        </div>
                        {/* error message */}
                        <small className="text-danger">
                            {this.state.errors.basic_salary
                                ? this.state.errors.basic_salary
                                : ""}
                        </small>
                    </div>
                </div>
                {/* Basic salary end */}

                {/* cash select */}
                <div className="mb-3 row">
                    <div className="col-2">
                        <label
                            htmlFor="employee_id"
                            className="mt-1 form-label"
                        ></label>
                    </div>

                    <div className="col-3">
                        <select
                            name="cash_id"
                            className="form-control"
                            defaultValue={""}
                            onChange={this.props.cashHandler}
                            id="cash-id"
                        >
                            {this.cashes.map((cash, index) => (
                                <option value={cash.id} key={index}>
                                    {cash.cash_name}
                                </option>
                            ))}
                        </select>
                        {/* error message */}
                        <small className="text-danger">
                            {this.state.errors.cash_id
                                ? this.state.errors.cash_id
                                : ""}
                        </small>
                    </div>
                </div>
                {/* cash select end */}

                {/* Bonus start */}
                <div className="mb-3 row">
                    <div className="col-2 ">
                        <label htmlFor="bonus" className="mt-1 form-label">
                            Bonus <small>(%)</small>
                        </label>
                    </div>
                    <div className="col-3">
                        <input
                            type="number"
                            name="bonus"
                            defaultValue={""}
                            className="form-control"
                            id="bonus"
                            placeholder="0.00"
                        />
                        {/* error message */}
                        <small className="text-danger">
                            {this.state.errors.bonus
                                ? this.state.errors.bonus
                                : ""}
                        </small>
                    </div>
                </div>
                {/* Basic salary end */}

                {/* Installment start */}
                <div className="mb-3 row">
                    <div className="col-2">
                        <label
                            htmlFor="installments"
                            className="mt-1 form-label"
                        >
                            Installments
                        </label>
                    </div>

                    <div className="col-3">
                        <input
                            type="number"
                            name="installments"
                            defaultValue={
                                this.state.currentEmployeeDetails
                                    .total_installment_sum
                            }
                            className="form-control"
                            id="installments"
                            placeholder="0.00"
                        />
                        {/* error message */}
                        <small className="text-danger">
                            {this.state.errors.installments
                                ? this.state.errors.installments
                                : ""}
                        </small>
                    </div>

                    <div className="col-2">
                        <input
                            type="number"
                            name="advanced"
                            defaultValue={
                                this.state.currentEmployeeDetails
                                    .total_advanced_sum
                            }
                            className="form-control"
                            id="installments"
                            placeholder="0.00"
                            readOnly
                        />
                        <small className="text-muted fst-italic">
                            Advance left
                        </small>
                    </div>
                </div>
                {/* Installment end  */}

                {/* Diduction start */}
                <div className="mb-3 row">
                    <div className="col-2">
                        <label htmlFor="deductions" className="mt-1 form-label">
                            Deductions
                        </label>
                    </div>

                    <div className="col-3">
                        <input
                            type="number"
                            name="deductions"
                            defaultValue=""
                            className="form-control"
                            id="deductions"
                            placeholder="0.00"
                        />

                        {/* error message */}
                        <small className="text-danger">
                            {this.state.errors.deductions
                                ? this.state.errors.deductions
                                : ""}
                        </small>
                    </div>
                </div>
                {/* Diduction end  */}

                {/* Description start */}
                <div className="mb-3 row">
                    <div className="col-2">
                        <label htmlFor="note" className="mt-1 form-label">
                            Note
                        </label>
                    </div>

                    <div className="col-5">
                        <textarea
                            name="note"
                            className="form-control"
                            id="note"
                            rows="2"
                            placeholder="Optional"
                        ></textarea>
                    </div>
                </div>
                {/* Description end */}
            </>
        );
    }
}

// DOM element
if (document.getElementById("employee-salary-create")) {
    // find element by id
    const element = document.getElementById("employee-salary-create");

    // create new props object with element's data-attributes
    const props = Object.assign({}, element.dataset);

    // render element with props (using spread)
    ReactDOM.render(<EmployeeSalary {...props} />, element);
}

