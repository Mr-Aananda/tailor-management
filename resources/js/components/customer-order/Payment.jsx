import React, { Component } from "react";
import ReactDOM from "react-dom";

export default class Payment extends Component {
    constructor(props) {
        super(props);

        // console.log(this.props);

    }


    render() {
        return (
            <>
                <fieldset>
                    <div className="mb-3">
                        <h5 className="text-muted">Payment</h5>
                    </div>

                    <div className="mb-1 row">
                        <div className="col-4">
                            <label className="mt-1 form-label">Subtotal</label>
                        </div>
                        <div className="col-8 text-end">
                            BDT. {this.props.subTotal}
                        </div>
                    </div>

                    <div className="mb-3 row">
                        <div className="col-4">
                            <label className="mt-1 form-label">Discount </label>
                        </div>
                        <div className="col-8 text-end">
                            <div className="mb-2 input-group">
                                <select
                                    name="discount_type"
                                    defaultValue={this.props.discountTypeEdit}
                                    onChange={this.props.discountTypeHandler}
                                    className="form-control"
                                >
                                    {/* <option value="Percentage">
                                        Percentage (%)
                                    </option>
                                    <option value="Flat">Flat</option> */}
                                    {Object.keys(this.props.discountTypes).map(
                                        (discountTypeKey) => (
                                            <option
                                                value={discountTypeKey}
                                                key={discountTypeKey}
                                            >
                                                {
                                                    this.props.discountTypes[
                                                        discountTypeKey
                                                    ]
                                                }
                                            </option>
                                        )
                                    )}
                                </select>

                                <input
                                    type="number"
                                    name="discount"
                                    defaultValue={this.props.discountEdit}
                                    onChange={this.props.discountHandler}
                                    onBlur={this.props.discountHandler}
                                    step="any"
                                    className="form-control text-end"
                                />
                            </div>
                            BDT. {this.props.discountAmount}
                        </div>
                    </div>

                    <div className="mb-3 row">
                        <div className="col-4">
                            <label className="mt-1 form-label">Voucher</label>
                        </div>
                        <div className="col-8 text-end">
                            <div className="mb-2 input-group">
                                <input
                                    id="voucher_amount"
                                    type="text"
                                    name="voucher_amount"
                                    defaultValue={""}
                                    step="any"
                                    className="form-control text-end"
                                />

                                <a
                                    className="btn btn-success"
                                    onClick={() =>
                                        this.props.voucherForPaymentHandler(
                                            document.querySelector(
                                                "#voucher_amount"
                                            ).value
                                        )
                                    }
                                >
                                    <i className="bi bi-search"></i>
                                </a>
                            </div>
                            <p className="text-start text-danger fst-italic">
                                {this.props.voucherError}{" "}
                            </p>
                            BDT. {this.props.voucherAmount}
                        </div>
                    </div>

                    <div className="mb-3 row">
                        <div className="col-4">
                            <label className="mt-1 form-label">
                                Grand total{" "}
                            </label>
                        </div>
                        <div className="col-8 text-end">
                            BDT. {this.props.grandTotal}
                        </div>
                    </div>

                    <div className="mb-2 row">
                        <div className="col-4">
                            <label className="mt-1 form-label fw-bold required">
                                Total paid{" "}
                            </label>
                        </div>
                        <div className="col-8">
                            <div className="mb-2 input-group">
                                <select
                                    name="payment_type"
                                    defaultValue={this.props.paymentTypeEdit}
                                    onChange={this.props.paymentTypeHandler}
                                    className="form-control"
                                >
                                    {/* {this.props.paymentTypes.map(
                                        (paymentType) => (
                                            <option
                                                value={paymentType.id}
                                                key={paymentType.id}
                                            >
                                                {paymentType.name}
                                            </option>
                                        )
                                    )} */}
                                    <option value="cash">Cash</option>
                                </select>
                                <input
                                    type="number"
                                    name="total_paid"
                                    defaultValue={this.props.totalPaidEdit}
                                    onChange={this.props.paidHandler}
                                    onBlur={this.props.paidHandler}
                                    step="any"
                                    className="form-control text-end"
                                />
                            </div>
                        </div>
                    </div>

                    <div className="mb-3 row">
                        <div className="col-4"></div>
                        <div className="col-8">
                            <div className="mb-2 input-group">
                                <select
                                    name="payment_type_id"
                                    defaultValue={this.props.cashEditId}
                                    onChange={this.props.cashHandler}
                                    className="form-control"
                                >
                                    {this.props.cashes.map((cash) => (
                                        <option value={cash.id} key={cash.id}>
                                            {cash.cash_name}
                                        </option>
                                    ))}
                                </select>
                            </div>
                        </div>
                    </div>

                    <div className="mb-3 row">
                        <div className="col-4">
                            <label className="mt-1 form-label">
                                {this.props.dueOrChangeStatus}{" "}
                            </label>
                        </div>
                        <div className="col-8 text-end">
                            BDT. {this.props.dueOrChange}
                        </div>
                    </div>

                    {/* For Fabric entry */}

                    <div className="mb-3 row">
                        <div className="col-4">
                            <label className="mt-1 form-label">
                                Fabric bill{" "}
                            </label>
                        </div>
                        <div className="col-8">
                            <input
                                type="number"
                                name="total_paid"
                                defaultValue={this.props.fabricBillEdit}
                                onChange={this.props.fabricBillHandler}
                                onBlur={this.props.fabricBillHandler}
                                step="any"
                                className="form-control text-end"
                                placeholder="0.00"
                            />
                        </div>
                    </div>

                    <div className="mb-3 row">
                        <div className="col-4">
                            <label className="mt-1 form-label">
                                Fabric paid{" "}
                            </label>
                        </div>
                        <div className="col-8">
                            <input
                                type="number"
                                name="total_paid"
                                defaultValue={this.props.fabricPaidEdit}
                                onChange={this.props.fabricPaidHandler}
                                onBlur={this.props.fabricPaidHandler}
                                step="any"
                                className="form-control text-end"
                                placeholder="0.00"
                            />
                        </div>
                    </div>
                    <div className="mb-3 row">
                        <div className="col-4">
                            <label className="mt-1 form-label">
                                Fabric due
                            </label>
                        </div>
                        <div className="col-8 text-end">
                            BDT. {this.props.fabricDue}
                        </div>
                    </div>
                </fieldset>
            </>
        );
    }
}

// DOM element
if (document.getElementById("payment")) {
    // find element by id
    const element = document.getElementById("payment");

    // create new props object with element's data-attributes
    const props = Object.assign({}, element.dataset);

    // render element with props (using spread)
    ReactDOM.render(<Payment {...props} />, element);
}
