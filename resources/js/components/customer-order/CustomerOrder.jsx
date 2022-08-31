import React, { Component } from "react";
import ReactDOM from "react-dom";
import MeasurementDetails from "./MeasurementDetails";
import Payment from "./Payment";
import { parseInt } from "lodash";
import axios from "axios";
import Select from "react-select";


class CustomerOrder extends Component {
    constructor(props) {
        super(props);
        // get old data
        this.paymentTypes = JSON.parse(this.props.paymentTypes);
        this.items = JSON.parse(this.props.items);
        this.fittings = JSON.parse(this.props.fittings);
        this.cashes = JSON.parse(this.props.cashes);
        this.designs = JSON.parse(this.props.designs);
        this.discountTypes = JSON.parse(this.props.discountTypes);
        this.employees = JSON.parse(this.props.employees);


        const isNewMainEntry = !this.props.customerOrder;
        // console.log(isNewMainEntry);

        const isAllCustomerInfo = !this.props.customerOrder;

        this.customerOrder = isNewMainEntry
            ? {}
            : JSON.parse(this.props.customerOrder);


        this.state = {
            visibleAllMeasurements: false,
            itemPart: [],
            subTotal: 0,
            discountType: "flat",
            paymentType: "cash",
            cashId: "1",
            discount: "",
            discountAmount: 0,
            voucherAmount: 0,
            grandTotal: 0,
            totalPaid: "",
            dueOrChangeStatus: "Due",
            dueOrChange: 0,
            allData: isNewMainEntry ? [] : JSON.parse(this.props.allEditData),
            allCustomerInfo: isAllCustomerInfo
                ? {
                      date: new Date().toISOString().substr(0, 10),
                    //   order_no: this.props.orderNo,
                      order_no: "",
                      delivery_date: "",
                      customer_name: "",
                      mobile_no: "",
                      address: "",
                  }
                : {
                      date: this.customerOrder.date,
                      order_no: this.customerOrder.order_no,
                      delivery_date: this.customerOrder.delivery_date,
                      customer_name: this.customerOrder.customer.customer_name,
                      mobile_no: this.customerOrder.customer.mobile_no,
                      address: this.customerOrder.customer.address,
                  },
            isMainUpdate: this.props.isMainUpdate == 0 ? false : true,
            errors: [],
            customers: JSON.parse(this.props.customers),
            hideNewCustomer: true,
            hideSelectInputForCustomer: false,
            selectedOldCustomer: null,
            designsWithSelectedItem: [],
            voucherError: "",
            fabricBill: 0,
            fabricPaid: 0,
            fabricDue: 0,
        };
        // console.log(this.items);
        // console.log(this.designs);
        // console.log(this.fittings);
        // console.log(this.state.allCustomerInfo);

    }

    // Format number
    formatNumber = (num) => {
        const precision = num.toFixed(2);
        return Number(precision);
    };

    measurementHandler = (measurementData) => {
        this.setState(
            {
                allData: measurementData,
            },
            () => {
                console.log(this.state.allData);
            }
        );
    };

    itemHandeler = (selectedValue) => {
        // console.log(e.target.value);
        let itemPartCheck = this.items.find(
            (item) => item.id === parseInt(selectedValue)
        ).item_part;

        this.setState({
            visibleAllMeasurements: true,
            itemPart: itemPartCheck,
        });

    };


    //For payment start

    //Subtotal and grandtotal start
    cartHandler = (e, cartItems) => {
        // console.log("card handler", e, cartItems);

        const subTotal = cartItems.reduce((total, cartItem) => {
            return (
                total +
                parseFloat(
                    this.items.find((_item) => _item.id == cartItem.item_id)
                        .price * parseFloat(cartItem.quantity)
                )
            );
        }, 0);

        this.setState({
            subTotal: subTotal,
            grandTotal: subTotal,
            dueOrChange: subTotal,
        });

        // set previous discount
        this.setState(
            {
                discount: this.props.discount,
            },
            this.getDiscountAmount
        );

        // set previous paid
        this.setState(
            {
                totalPaid: this.props.totalPaid,
            },
            this.getTotalPaid
        );
    };
    //Subtotal and grandtotal end

    paymentTypeHandler = (e) => {
        this.setState({
            paymentType: e.target.value,
        });
    };

    cashHandler = (e) => {
        this.setState({
            cashId: e.target.value,
        });
    };

    discountTypeHandler = (e) => {
        this.setState(
            {
                discountType: e.target.value,
            },
            this.getDiscountAmount
        );
    };

    discountHandler = (e) => {
        this.setState(
            {
                discount: e.target.value,
            },
            this.getDiscountAmount
        );
    };

    getDiscountAmount = () => {
        let discount = this.state.discount || 0;

        if (this.state.discountType === "percentage") {
            discount = (this.state.subTotal * discount) / 100;
        }

        this.setState(
            {
                discountAmount: discount,
            },
            this.getGrandTotal
        );
    };

    getGrandTotal = () => {
        this.setState(
            {
                grandTotal:
                    this.state.subTotal -
                    this.state.discountAmount -
                    this.state.voucherAmount,
            },
            this.getTotalPaid
        );
        // console.log(this.state.grandTotal);
    };

    paidHandler = (e) => {
        this.setState(
            {
                totalPaid: e.target.value,
            },
            this.getTotalPaid
        );
    };

    getTotalPaid = () => {
        this.setState(
            {
                dueOrChange:
                    this.state.grandTotal - (this.state.totalPaid || 0),
            },
            () => {
                if (this.state.dueOrChange >= 0) {
                    this.setState({ dueOrChangeStatus: "Due" });
                } else {
                    this.setState({ dueOrChangeStatus: "Change" });
                }
            }
        );
    };

    //Payment end

    componentDidMount() {
        let customerType = this.props.customerOrder
            ? "oldCustomer"
            : "newCustomer";

        this.hideCustomerHandler(customerType);
        this.setState({
            selectedOldCustomer: this.props.customerOrder
                ? JSON.parse(this.props.customerOrder).customer
                : null,

            fabricBill: this.props.fabricBill,
            fabricPaid: this.props.fabricPaid,
            fabricDue:
                this.props.fabricBill - this.props.fabricPaid
                    ? this.props.fabricBill - this.props.fabricPaid
                    : 0,
        });
    }

    //Fabric option function start

    fabricBillHandler = (e) => {
        this.setState({
            fabricBill: e.target.value,
        });
    };

    fabricPaidHandler = (e) => {
        this.setState(
            {
                fabricPaid: e.target.value,
            },
            this.getFabricDueHandler
        );
    };

    getFabricDueHandler = () => {
        this.setState({
            fabricDue: this.state.fabricBill - (this.state.fabricPaid || 0),
        });
    };
    //Fabric option function end

    handleChangeCustomer = (e, index) => {
        const { name, value } = e.target;

        this.setState((prevState) => ({
            allCustomerInfo: { ...prevState.allCustomerInfo, [name]: value },
        }));
    };

    handleChangePayment = (e, index) => {
        const { name, value } = e.target;

        this.setState((prevState) => ({
            allPayment: { ...prevState.allPayment, [name]: value },
        }));
    };

    //Change customer information field by radio button start
    hideCustomerHandler = (value) => {
        this.setState({
            hideNewCustomer: value == "oldCustomer" ? false : true,
            hideSelectInputForCustomer: value == "oldCustomer" ? true : false,
        });
    };

    // showOldCustomerHandler = (e) => {
    //     this.setState({
    //         hideNewCustomer: false,
    //         hideSelectInputForCustomer: true,
    //     });
    // };

    //Change customer information field by radio button end

    //Old customer order select option function start
    selectedOldCustomerHandler = (selectedOldCustomer) => {
        // console.log(selectedOldCustomer);
        this.setState({
            selectedOldCustomer: selectedOldCustomer,
            allCustomerInfo: {
                ...this.state.allCustomerInfo,
                mobile_no: selectedOldCustomer.mobile_no,
            },
        });

        // console.log(this.state.selectedOldCustomer);
    };

    //Old customer order select option function end

    //Previous customer order (for copy previous order) start
    handlePreviousOrderCustomer = (value) => {
        // console.log(value);
        this.setState({
            selectedOldCustomer: value,
            allCustomerInfo: {
                ...this.state.allCustomerInfo,
                mobile_no: value.mobile_no,
            },
        });
    };
    //Previous customer order (for copy previous order) end

    // Axios for get designs by item start
    designsForItemHandler = (itemId, attempt = 0) => {
        axios
            .post(baseURL + "axios/getDesignByItemId", {
                item_id: itemId,
            })
            .then((response) => {
                // update state
                this.setState({
                    designsWithSelectedItem: response.data,
                });

                // console.log(response.data);
            })
            .catch((reason) => {
                console.log(reason);
                if (attempt == 5) {
                    alert('Failed to load designs. Try again later.')
                    return;
                }
                console.info('Retry attempt = ' + (attempt + 1))
                this.designsForItemHandler(itemId, ++attempt);
            });
    };
    // Axios for get designs by item start

    //Axios get voucher number or name and calculation start

    voucherForPaymentHandler = (voucher_amount) => {
        axios
            .post(baseURL + "axios/getVouchernumberOrname", {
                voucher_or_name: voucher_amount,
            })
            .then((response) => {
                console.log(response.data);
                let voucher_discount = parseFloat(response.data.discount);
                if (response.data.discount_type === "percentage") {
                    voucher_discount =
                        (this.state.subTotal * voucher_discount) / 100;
                }

                let totalQuantity = 0;
                this.state.allData.forEach((data) => {
                    totalQuantity += parseFloat(data.quantity);
                });
                // console.log(totalQuantity);

                this.setState({
                    voucherAmount: voucher_discount * totalQuantity,
                });
                this.setState({
                    grandTotal:
                        this.state.grandTotal - this.state.voucherAmount,
                });
                this.setState({
                    dueOrChange: this.state.grandTotal,
                });
            })
            .catch((reason) => {
                console.log(reason);
                this.setState({
                    voucherError: "Voucher not found",
                });
            });
    };

    //Axios get voucher number or name and calculation start

    //All data send to customer-order controller
    sendAllDataSubmit = (e) => {
        this.state;

        axios
            .post(baseURL + "axios/recieveAllData", {
                allData: this.state.allData,
                ...this.state.allCustomerInfo,
                discount_type: this.state.discountType,
                sub_total: this.state.subTotal,
                discount: this.state.discount,
                voucher_amount: this.state.voucherAmount,
                grand_total: this.state.grandTotal,
                payment_type: this.state.paymentType,
                cash_id: this.state.cashId,
                total_paid: this.state.totalPaid,
                fabric_bill: this.state.fabricBill,
                fabric_paid: this.state.fabricPaid,
            })
            .then((response) => {
                console.log(response.data);

                window.location.reload();
            })
            .catch((reason) => {
                console.log(reason);
                if (reason.response) {
                    this.setState({
                        errors: reason.response.data.errors,
                    });
                }
            });
    };

    //updatet for customer order

    updatedAllDataSubmit = (e) => {
        axios
            .post(baseURL + "axios/updatedAllData/" + this.customerOrder.id, {
                allData: this.state.allData,
                ...this.state.allCustomerInfo,
                discount_type: this.state.discountType,
                sub_total: this.state.subTotal,
                discount: this.state.discount,
                voucher_amount: this.state.voucherAmount,
                grand_total: this.state.grandTotal,
                payment_type: this.state.paymentType,
                total_paid: this.state.totalPaid,
                cash_id: this.state.cashId,
                fabric_bill: this.state.fabricBill,
                fabric_paid: this.state.fabricPaid,
            })
            .then((response) => {
                console.log(response.data);
                window.location.reload();
            })
            .catch((reason) => {
                console.log(reason.response);
            });
    };

    render() {
        return (
            <>
                {/* Measurement Start */}
                <div>
                    <MeasurementDetails
                        items={this.items}
                        fittings={this.fittings}
                        designs={this.designs}
                        itemHandeler={this.itemHandeler}
                        cartHandler={this.cartHandler}
                        visibleAllMeasurements={
                            this.state.visibleAllMeasurements
                        }
                        itemPart={this.state.itemPart}
                        measurementHandler={this.measurementHandler}
                        allEditData={this.props.allEditData}
                        images={this.props.images}
                        designsForItemHandler={this.designsForItemHandler}
                        designsWithSelectedItem={
                            this.state.designsWithSelectedItem
                        }
                        employees={this.employees}
                        customers={this.state.customers}
                        hideCustomerHandler={this.hideCustomerHandler}
                        handlePreviousOrderCustomer={
                            this.handlePreviousOrderCustomer
                        }
                        selectedOldCustomerHandler={
                            this.selectedOldCustomerHandler
                        }
                    />
                </div>

                {/* Measurement End */}

                <div className="row">
                    <div className="col-7">
                        <div className="mb-3 text-muted">
                            <h5>Customer Information</h5>
                        </div>

                        <div className="mb-3 row">
                            {/* <!-- date start--> */}
                            <div className="col-3">
                                <label
                                    htmlFor="date"
                                    className="mt-1 form-label required"
                                >
                                    Date
                                </label>
                                <input
                                    type="date"
                                    name="date"
                                    defaultValue={
                                        !this.props.customerOrder
                                            ? this.state.allCustomerInfo.date
                                            : this.props.date
                                    }
                                    //  defaultValue={ this.props.date }
                                    // value={this.state.allCustomerInfo.date}

                                    onChange={this.handleChangeCustomer}
                                    className="form-control"
                                    id="date"
                                    required
                                />
                                <small className="text-danger">
                                    {Object.keys(this.state.errors).length > 0
                                        ? this.state.errors.date
                                            ? this.state.errors.date[0]
                                            : ""
                                        : ""}
                                </small>
                            </div>
                            {/* <!-- date end--> */}

                            {/* <!-- order no start--> */}
                            <div className="col-3">
                                <label
                                    htmlFor="order-no"
                                    className="mt-1 form-label required"
                                >
                                    Order no
                                </label>
                                <input
                                    type="text"
                                    name="order_no"
                                    value={this.props.orderNo}
                                    placeholder="#####"
                                    // defaultValue={
                                    //     this.state.allCustomerInfo.order_no
                                    // }
                                    // value={this.state.allCustomerInfo.order_no}
                                    onChange={this.handleChangeCustomer}
                                    className="form-control"
                                    id="order-no"
                                    required
                                />
                                <small className="text-danger">
                                    {Object.keys(this.state.errors).length > 0
                                        ? this.state.errors.order_no
                                            ? this.state.errors.order_no[0]
                                            : ""
                                        : ""}
                                </small>
                            </div>
                            {/* <!-- order no end--> */}

                            {/* <!-- Delivery date start--> */}
                            <div className="col-3">
                                <label
                                    htmlFor="delivery-date"
                                    className="mt-1 form-label required"
                                >
                                    Delivery Date
                                </label>
                                <input
                                    type="date"
                                    name="delivery_date"
                                    defaultValue={this.props.deliveryDate}
                                    // value={
                                    //     this.state.allCustomerInfo.delivery_date
                                    // }
                                    onChange={this.handleChangeCustomer}
                                    className="form-control"
                                    id="delivery-date"
                                    required
                                />
                                <small className="text-danger">
                                    {Object.keys(this.state.errors).length > 0
                                        ? this.state.errors.delivery_date
                                            ? this.state.errors.delivery_date[0]
                                            : ""
                                        : ""}
                                </small>
                            </div>
                            {/* <!-- Delivery date end--> */}
                        </div>

                        <div className="row my-2">
                            <div className="col-10 d-flex justify-content-start">
                                <div className="form-check me-4">
                                    <input
                                        className="form-check-input"
                                        type="radio"
                                        name="flexRadioDefault"
                                        onChange={(e) =>
                                            this.hideCustomerHandler(
                                                e.target.value
                                            )
                                        }
                                        id="flexRadioDefault1"
                                        value="newCustomer"
                                        defaultChecked={
                                            !this.props.customerOrder ||
                                            !this.state.selectedOldCustomer
                                        }
                                    />
                                    <label
                                        className="form-check-label"
                                        htmlFor="flexRadioDefault1"
                                    >
                                        New customer
                                    </label>
                                </div>
                                <div className="form-check">
                                    <input
                                        className="form-check-input"
                                        type="radio"
                                        onChange={(e) =>
                                            this.hideCustomerHandler(
                                                e.target.value
                                            )
                                        }
                                        name="flexRadioDefault"
                                        value="oldCustomer"
                                        id="flexRadioDefault2"
                                        defaultChecked={
                                            this.props.customerOrder ||
                                            this.state.selectedOldCustomer
                                        }
                                    />
                                    <label
                                        className="form-check-label"
                                        htmlFor="flexRadioDefault2"
                                    >
                                        Old customer
                                    </label>
                                </div>
                            </div>
                        </div>

                        {this.state.hideNewCustomer && (
                            <>
                                {/* <!-- customer name start--> */}
                                <div className="mb-3 row">
                                    <div className="col-5">
                                        <label
                                            htmlFor="customer-name"
                                            className="mt-1 form-label"
                                        >
                                            Customer name
                                        </label>
                                        <input
                                            type="text"
                                            name="customer_name"
                                            // defaultValue={
                                            //     this.state.allCustomerInfo
                                            //         .customer_name
                                            // }
                                            // value={
                                            //     this.state.allCustomerInfo.customer_name
                                            // }
                                            onChange={this.handleChangeCustomer}
                                            className="form-control"
                                            id="customer-name"
                                            placeholder="Characters only"
                                        />
                                        {/* error */}
                                        <small className="text-danger">
                                            {Object.keys(this.state.errors)
                                                .length > 0
                                                ? this.state.errors
                                                      .customer_name
                                                    ? this.state.errors
                                                          .customer_name[0]
                                                    : ""
                                                : ""}
                                        </small>
                                    </div>
                                    {/* <!-- customer name end--> */}

                                    {/* <!-- customer mobile start--> */}
                                    <div className="col-4">
                                        <label
                                            htmlFor="mobile-no"
                                            className="mt-1 form-label"
                                        >
                                            Mobile no
                                        </label>
                                        <input
                                            type="text"
                                            name="mobile_no"
                                            // defaultValue={
                                            //     this.state.allCustomerInfo
                                            //         .mobile_no
                                            // }
                                            // value={this.state.allCustomerInfo.mobile_no}
                                            onChange={this.handleChangeCustomer}
                                            className="form-control"
                                            id="mobile-no"
                                            placeholder="Numbers only"
                                        />
                                        <small className="text-danger">
                                            {Object.keys(this.state.errors)
                                                .length > 0
                                                ? this.state.errors.mobile_no
                                                    ? this.state.errors
                                                          .mobile_no[0]
                                                    : ""
                                                : ""}
                                        </small>
                                    </div>
                                    {/* <!-- customer mobile end--> */}
                                </div>

                                <div className="mb-3 row">
                                    {/* <!-- Delivery date start--> */}
                                    <div className="col-9">
                                        <label
                                            htmlFor="address"
                                            className="mt-1 form-label"
                                        >
                                            Address
                                        </label>
                                        <textarea
                                            name="address"
                                            // defaultValue={
                                            //     this.state.allCustomerInfo
                                            //         .address
                                            // }
                                            // value={this.state.allCustomerInfo.address}
                                            onChange={this.handleChangeCustomer}
                                            className="form-control"
                                            id="address"
                                            rows="3"
                                            placeholder="Optional"
                                        ></textarea>
                                    </div>
                                    {/* <!-- Delivery date end--> */}
                                </div>
                            </>
                        )}
                        {this.state.hideSelectInputForCustomer && (
                            <div className="row mb-3">
                                <div className="col-8">
                                    <label
                                        htmlFor="customer-id"
                                        className="mt-1 form-label required"
                                    >
                                        Select customer
                                    </label>
                                    <Select
                                        name="customer_id"
                                        id="customer-id"
                                        required
                                        getOptionLabel={(customer) =>
                                            `${customer.customer_name} - ${customer.mobile_no}`
                                        }
                                        getOptionValue={(customer) =>
                                            customer.id
                                        }
                                        options={this.state.customers}
                                        value={this.state.selectedOldCustomer}
                                        onChange={
                                            this.selectedOldCustomerHandler
                                        }
                                    />
                                </div>
                            </div>
                        )}
                    </div>
                    <div className="col-5">
                        <Payment
                            subTotal={this.state.subTotal}
                            discountType={this.state.discountType}
                            discount={this.state.discount}
                            discountAmount={this.state.discountAmount}
                            voucherAmount={this.state.voucherAmount}
                            voucherForPaymentHandler={
                                this.voucherForPaymentHandler
                            }
                            voucherError={this.state.voucherError}
                            grandTotal={this.state.grandTotal}
                            totalPaid={this.state.totalPaid}
                            dueOrChange={this.state.dueOrChange}
                            dueOrChangeStatus={this.state.dueOrChangeStatus}
                            discountTypeHandler={this.discountTypeHandler}
                            discountHandler={this.discountHandler}
                            paidHandler={this.paidHandler}
                            discountTypes={this.discountTypes}
                            paymentTypes={this.paymentTypes}
                            cashes={this.cashes}
                            paymentType={this.state.paymentType}
                            cashHandler={this.cashHandler}
                            cashId={this.state.cashId}
                            paymentTypeHandler={this.paymentTypeHandler}
                            fabricBillHandler={this.fabricBillHandler}
                            fabricPaidHandler={this.fabricPaidHandler}
                            fabricDue={this.state.fabricDue}
                            //from edit
                            paymentTypeEdit={this.props.paymentTypeEdit}
                            cashEditId={this.props.cashEditId}
                            totalPaidEdit={this.props.totalPaid}
                            fabricBillEdit={this.props.fabricBill}
                            fabricPaidEdit={this.props.fabricPaid}
                            discountTypeEdit={this.props.discountType}
                            discountEdit={this.props.discount}
                        />
                    </div>
                </div>
                <div className="mb-3 row text-end ">
                    {this.state.isMainUpdate ? (
                        <div className="col-12 mt-2">
                            <button
                                type="reset"
                                className="btn btn-warning me-2"
                            >
                                <i className="bi bi-dash-square"></i>
                                <span className="p-1">Reset</span>
                            </button>
                            <button
                                type="button"
                                onClick={this.sendAllDataSubmit}
                                className="btn btn-primary"
                            >
                                <i className="bi bi-plus-square"></i>
                                <span className="p-1">Save</span>
                            </button>
                        </div>
                    ) : (
                        <div className="col-12 mt-2">
                            <button
                                type="button"
                                onClick={this.updatedAllDataSubmit}
                                className="btn btn-primary"
                            >
                                <i className="bi bi-plus-square"></i>
                                <span className="p-1">Update</span>
                            </button>
                        </div>
                    )}
                </div>
            </>
        );
    }
}

export default CustomerOrder;

// DOM element
if (document.getElementById("CustomerOrder")) {
    // find element by id
    const element = document.getElementById("CustomerOrder");

    // create new props object with element's data-attributes
    const props = Object.assign({}, element.dataset);

    // render element with props (using spread)
    ReactDOM.render(<CustomerOrder {...props} />, element);
}
