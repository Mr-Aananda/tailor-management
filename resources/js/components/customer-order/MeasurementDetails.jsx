import React, { Component } from "react";
import Select from "react-select";
import LowerMeasurement from "./LowerMeasurement";
import UpperMeasurement from "./UpperMeasurement";
import { Button, Col, Container, Modal, Row } from "react-bootstrap";


class MeasurementDetails extends Component {
    constructor(props) {
        super(props);

        const isNewEntry = !this.props.allEditData; // come from new entry customer order
        // console.log(JSON.parse(this.props.allEditData));
        // console.log(JSON.parse(this.props.images));

        this.state = {
            dummyDesignId: null,
            select: {
                value: null,
            },
            measurements: {
                item_id: "",
                image_id: "",
                master_id: "",
                design_ids: [],
                fitting_id: "",
                quantity: 1,
                // upper part
                upper_length: "",
                round_body: "",
                belly: "",
                upper_hip: "",
                solder: "",
                sleeve: "",
                coff: "",
                neck: "",
                body_front: "",
                belly_front: "",
                hip_front: "",
                down: "",
                straight: "",
                // lower part
                lower_length: "",
                muhuri: "",
                knee: "",
                thigh: "",
                waist: "",
                lower_hip: "",
                high: "",
                front_down: "",
                back_down: "",
                fly: "",
                front: "",
                back: "",
            },
            allData: isNewEntry ? [] : JSON.parse(this.props.allEditData),
            isUpdating: false,
            updatingIndex: null,
            isNewEntry: isNewEntry,

            showImageModal: false,
            showPreviousOrderModel: false,
            previousOrders: [],
            selectedPreviousOrder: null,
            selectedOption: null,
            images: JSON.parse(this.props.images),
        };

        if (!isNewEntry) {
            this.props.cartHandler(null, JSON.parse(this.props.allEditData));
        }
    }

    handleChange = (e) => {
        const { name, value } = e.target;

        this.setState((prevState) => ({
            measurements: { ...prevState.measurements, [name]: value },
        }));

        // console.log(this.state.measurements);
    };

    //Submit all measurement data start
    handleSubmitMeasurements = (e) => {
        e.preventDefault();

        const data = [...this.state.allData];

        if (this.state.isUpdating) {
            data.splice(this.state.updatingIndex, 1, {
                ...this.state.measurements,
            });
        } else {
            data.push({
                ...this.state.measurements,
            });
        }

        // console.log(data);

        this.setState({
            allData: data,
            select: {
                value: null,
            },
            measurements: {
                dummyDesignId: null,
                item_id: "",
                image_id: "",
                master_id: "",
                design_ids: [],
                fitting_id: "",
                quantity: 1,
                // upper part
                upper_length: "",
                round_body: "",
                belly: "",
                upper_hip: "",
                solder: "",
                sleeve: "",
                coff: "",
                arm: "",
                mussle: "",
                neck: "",
                body_front: "",
                belly_front: "",
                hip_front: "",
                down: "",
                straight: "",
                // lower part
                lower_length: "",
                muhuri: "",
                knee: "",
                thigh: "",
                waist: "",
                lower_hip: "",
                high: "",
                front_down: "",
                back_down: "",
                fly: "",
                front: "",
                back: "",
            },
            isUpdating: false,
        });

        this.props.cartHandler(e, data);
        this.props.measurementHandler(data);
        // console.log(this.state.allData);
    };

    //Submit all measurement data end

    //Remove from cart start
    deleteItem = (event, index) => {
        const dataDelete = [...this.state.allData];
        dataDelete.splice(index, 1);

        this.setState({
            allData: dataDelete,
        });

        this.props.measurementHandler(dataDelete);
        this.props.cartHandler(event, dataDelete);
    };
    //Remove from cart end

    //Edit cart item start
    editItem = (e, data) => {
        // console.log(data);

        for (const key in data) {
            if (Object.hasOwnProperty.call(data, key)) {
                const element = data[key];
                if (element === null) {
                    data[key] = "";
                }
            }
        }
        //  this.props.itemHandeler(9);

        const selectedIds = [...data.design_ids];

        const selectedDesigns = selectedIds.map((_id) => {
            return this.props.designs.find((_design) => _design.id == _id);
        });

        const updatingIndex = this.state.allData.indexOf(data);

        this.setState({
            select: {
                value: selectedDesigns,
            },
            measurements: { ...data },
            isUpdating: true,
            updatingIndex: updatingIndex,
        });

        // TODO .....
        this.props.itemHandeler(data.item_id);
    };
    //Edit cart item end

    copyItem = (copyData) => {
        console.log(this.state.previousOrders);
        for (const key in copyData) {
            //  console.log(key, copyData[key]);
            if (Object.hasOwnProperty.call(copyData, key)) {
                const element = copyData[key];
                if (element === null) {
                    copyData[key] = "";
                }
                //  console.log(element);
            }
        }

        const selectedIds = [...copyData.design_ids];

        const selectedDesigns = selectedIds.map((_id) => {
            return this.props.designs.find((_design) => _design.id == _id);
        });

        // const updatingIndex = this.state.allData.indexOf(copyData);

        this.setState({
            select: {
                value: selectedDesigns,
            },
            measurements: { ...copyData },
            // updatingIndex: updatingIndex,
        });

        this.props.itemHandeler(copyData.item_id);
    };

    onChangeHandlerforcopyItem = (e) => {
        let selectedOrder = this.state.previousOrders.find(
            (order) => order.id == e.target.value
        );
        this.setState({
            selectedPreviousOrder: selectedOrder,
        });
        // console.log(this.state.selectedPreviousOrder);
    };

    imageHandleModal = (e) => {
        this.setState({
            showImageModal: !this.state.showImageModal,
        });
    };

    previousOrderHandleModal = () => {
        this.props.hideCustomerHandler("oldCustomer");
        this.setState({
            showPreviousOrderModel: !this.state.showPreviousOrderModel,
        });
    };

    previousOrderHandler = (selectedOption) => {
        let customer = this.props.customers.find(
            (customer) => customer.id == selectedOption.id
        );
        this.props.handlePreviousOrderCustomer(customer);
        this.setState({ selectedOption }, () =>
            // console.log(this.state.selectedOption)
            this.getPreviousOrder(selectedOption.id)
        );
    };

    getPreviousOrder = (id) => {
        axios
            .post(baseURL + "axios/getPreviousOrderByCustomerId", {
                customer_id: id,
            })
            .then((response) => {
                // update state
                this.setState({
                    previousOrders: response.data,
                });

                // console.log(response.data);
            })
            .catch((reason) => {
                console.log(reason);
            });
    };

    render() {
        const { selectedOption } = this.state;

        const cartList = this.state.allData.map((data, index) => {
            const currentItem = this.props.items.find(
                (item) => item.id == data.item_id
            );

            const fitting = this.props.fittings.find(
                (_fitting) => _fitting.id == data.fitting_id
            );

            // const image = this.state.images.find((_image)=>_image.id=data.image_id)

            return (
                <tr key={index}>
                    <th scope="row">{index + 1}</th>
                    <td className="fw-bold">{currentItem.item_name}</td>
                    <td className="text-wrap">
                        {currentItem.item_part === "Upper part" ? (
                            <p>
                                Length :{data.upper_length}, Round body :
                                {data.round_body}, Belly : {data.belly}, Upper
                                hip :{data.upper_hip}, Solder : {data.solder},
                                Sleeve : {data.sleeve}, Coff : {data.coff}, arm:{" "}
                                {data.arm}, mussle: {data.mussle}, Neck:
                                {data.neck}, Body front :{data.body_front},
                                Belly front :{data.belly_front}, Hip front :{" "}
                                {data.hip_front}, Down(D) :{data.down},
                                Straight(S) :{data.straight}
                            </p>
                        ) : (
                            <p>
                                Length :{data.lower_length}, Muhuri :
                                {data.muhuri}, Knee :{data.knee}, Thigh :
                                {data.thigh}, Waist :{data.waist}, Lower hip :
                                {data.lower_hip}, High :{data.high}, Front down
                                :{data.front_down}, Back down :{data.back_down},
                                Fly :{data.fly}, Front :{data.front}, Back :
                                {data.back},
                            </p>
                        )}
                        <p>
                            Designs :{" "}
                            {data.design_ids
                                .map(
                                    (design_id) =>
                                        this.props.designs.find(
                                            (_design) => _design.id == design_id
                                        ).design_name
                                )
                                .join(", ")}
                        </p>
                        <p>
                            Fitting :{fitting.fitting_name}, Qty :
                            {data.quantity}
                        </p>

                        {/* <p>
                            Image no :{image.image},
                        </p> */}
                    </td>
                    <td className="print-none text-end">
                        <a
                            href="#"
                            className="btn table-small-button text-success"
                            onClick={(e) => {
                                this.editItem(e, data);
                                this.props.designsForItemHandler(data.item_id);
                            }}
                            title="Update"
                        >
                            <i className="bi bi-pencil-square"></i>
                        </a>

                        <a
                            href="#"
                            className="btn table-small-button text-danger"
                            title="delete"
                            onClick={(e) => this.deleteItem(e, index)}
                        >
                            <i className="bi bi-x-circle-fill"></i>
                        </a>
                    </td>
                </tr>
            );
        });

        return (
            <>
                <div className="row">
                    <h5 className="text-muted">Measurements</h5>
                    <form onSubmit={this.handleSubmitMeasurements}>
                        <div className="col-12">
                            {/* Select item start */}
                            <div className="my-2 row">
                                <div className="col-3">
                                    <label
                                        htmlFor="item-id"
                                        className="mt-1 form-label required"
                                    >
                                        Select Item
                                    </label>
                                    <select
                                        name="item_id"
                                        className="form-control"
                                        value={this.state.measurements.item_id}
                                        onChange={(e) => {
                                            this.setState({
                                                select: {
                                                    value: null,
                                                },
                                                measurements: {
                                                    item_id: e.target.value,
                                                    image_id: "",
                                                    master_id: "",
                                                    design_ids: [],
                                                    fitting_id: "",
                                                    quantity: 1,
                                                    // upper part
                                                    upper_length: "",
                                                    round_body: "",
                                                    belly: "",
                                                    upper_hip: "",
                                                    solder: "",
                                                    sleeve: "",
                                                    coff: "",
                                                    arm: "",
                                                    mussle: "",
                                                    neck: "",
                                                    body_front: "",
                                                    belly_front: "",
                                                    hip_front: "",
                                                    down: "",
                                                    straight: "",
                                                    // lower part
                                                    lower_length: "",
                                                    muhuri: "",
                                                    knee: "",
                                                    thigh: "",
                                                    waist: "",
                                                    lower_hip: "",
                                                    high: "",
                                                    front_down: "",
                                                    back_down: "",
                                                    fly: "",
                                                    front: "",
                                                    back: "",
                                                },
                                            });
                                            this.props.itemHandeler(
                                                e.target.value
                                            );
                                            this.handleChange(e);
                                            this.props.designsForItemHandler(
                                                e.target.value
                                            );
                                        }}
                                        id="item-id"
                                        required
                                    >
                                        <option value="">--</option>
                                        {this.props.items.map((item) => (
                                            <option
                                                value={item.id}
                                                key={item.id}
                                            >
                                                {item.item_name}
                                            </option>
                                        ))}
                                    </select>
                                </div>
                                {/* Select item end */}
                                {/* Master select start */}

                                <div className="col-2">
                                    <label
                                        htmlFor="master-id"
                                        className="mt-1 form-label required"
                                    >
                                        Select master
                                    </label>
                                    <select
                                        name="master_id"
                                        className="form-control"
                                        value={
                                            this.state.measurements.master_id
                                        }
                                        onChange={this.handleChange}
                                        id="item-id"
                                        required
                                    >
                                        <option value="">--</option>
                                        {this.props.employees.map((master) => (
                                            <option
                                                value={master.id}
                                                key={master.id}
                                            >
                                                {master.employee_name}
                                            </option>
                                        ))}
                                    </select>
                                </div>

                                {/* Master select end */}

                                {/* React modal for image */}
                                <div className="col-2">
                                    <div>
                                        <label htmlFor=""></label>
                                    </div>
                                    <Button
                                        onClick={this.imageHandleModal}
                                        variant="success"
                                        className="mt-1 text-white"
                                    >
                                        <span className="text-white me-2">
                                            <i className="bi bi-images"></i>
                                        </span>
                                        Select Image
                                    </Button>

                                    <Modal
                                        show={this.state.showImageModal}
                                        size="lg"
                                        aria-labelledby="contained-modal-title-vcenter"
                                    >
                                        <Modal.Header
                                            closeButton
                                            onHide={this.imageHandleModal}
                                        >
                                            {/* <Modal.Title>
                                                Modal title
                                            </Modal.Title> */}
                                        </Modal.Header>

                                        <Modal.Body>
                                            <Container>
                                                <Row>
                                                    {this.state.images.map(
                                                        (image, index) => (
                                                            <Col
                                                                xs={4}
                                                                md={3}
                                                                key={index}
                                                            >
                                                                <div className="form-check">
                                                                    <input
                                                                        className="form-check-input"
                                                                        type="radio"
                                                                        name="image_id"
                                                                        checked={
                                                                            image.id ==
                                                                            this
                                                                                .state
                                                                                .measurements
                                                                                .image_id
                                                                        }
                                                                        value={
                                                                            image.id
                                                                        }
                                                                        id={
                                                                            "image" +
                                                                            index
                                                                        }
                                                                        onChange={
                                                                            this
                                                                                .handleChange
                                                                        }
                                                                    />
                                                                    <label
                                                                        className="form-check-label"
                                                                        htmlFor={
                                                                            "image" +
                                                                            index
                                                                        }
                                                                    >
                                                                        <img
                                                                            src={
                                                                                image.url
                                                                            } //Url from image model to get image path
                                                                            className="img-fluid"
                                                                            width="120px"
                                                                            alt="image"
                                                                        />
                                                                    </label>
                                                                </div>
                                                            </Col>
                                                        )
                                                    )}
                                                </Row>
                                            </Container>
                                        </Modal.Body>

                                        <Modal.Footer>
                                            <Button
                                                onClick={this.imageHandleModal}
                                                className="btn-sm"
                                                variant="secondary"
                                            >
                                                Close
                                            </Button>
                                            <Button
                                                onClick={this.imageHandleModal}
                                                className="btn-sm"
                                                variant="primary"
                                            >
                                                Add image
                                            </Button>
                                        </Modal.Footer>
                                    </Modal>
                                </div>
                                {/* React modal for image */}

                                {/* React modal previous records */}
                                <div className="col-5 text-end">
                                    <div>
                                        <label htmlFor=""></label>
                                    </div>
                                    <Button
                                        onClick={this.previousOrderHandleModal}
                                        variant="primary"
                                        className="mt-1 text-white"
                                    >
                                        <span className="text-white me-2">
                                            <i className="bi bi-cart3"></i>
                                        </span>
                                        Previous orders
                                    </Button>

                                    <Modal
                                        show={this.state.showPreviousOrderModel}
                                        size="lg"
                                        aria-labelledby="contained-modal-title-vcenter"
                                    >
                                        <Modal.Header
                                            closeButton
                                            onHide={
                                                this.previousOrderHandleModal
                                            }
                                        >
                                            <Modal.Title>
                                                Previous orders
                                            </Modal.Title>
                                        </Modal.Header>

                                        <Modal.Body className="mb-5">
                                            <Container>
                                                <div className="row">
                                                    <div className="col-6">
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
                                                            getOptionLabel={(
                                                                customer
                                                            ) =>
                                                                `${customer.customer_name} - ${customer.mobile_no}`
                                                            }
                                                            getOptionValue={(
                                                                customer
                                                            ) => customer.id}
                                                            // isMulti={true}
                                                            value={
                                                                selectedOption
                                                            }
                                                            options={
                                                                this.props
                                                                    .customers
                                                            }
                                                            onChange={
                                                                this
                                                                    .previousOrderHandler
                                                            }
                                                        />
                                                    </div>

                                                    <div className="col-6">
                                                        <label
                                                            htmlFor="item-id"
                                                            className="mt-1 form-label required"
                                                        >
                                                            Select item
                                                        </label>
                                                        <select
                                                            name="item_id"
                                                            onChange={
                                                                this
                                                                    .onChangeHandlerforcopyItem
                                                            }
                                                            className="form-control"
                                                            id="item-id"
                                                            required
                                                        >
                                                            <option value="">
                                                                --
                                                            </option>
                                                            {this.state.previousOrders.map(
                                                                (order) => (
                                                                    <option
                                                                        value={
                                                                            order.id
                                                                        }
                                                                        key={
                                                                            order.id
                                                                        }
                                                                    >
                                                                        {`${
                                                                            order
                                                                                .item
                                                                                .item_name
                                                                        } ( ${order.created_at.substr(
                                                                            0,
                                                                            10
                                                                        )} )`}
                                                                    </option>
                                                                )
                                                            )}
                                                        </select>
                                                    </div>
                                                </div>
                                            </Container>
                                        </Modal.Body>

                                        <Modal.Footer>
                                            <Button
                                                onClick={
                                                    this
                                                        .previousOrderHandleModal
                                                }
                                                className="btn-sm"
                                                variant="secondary"
                                            >
                                                Close
                                            </Button>
                                            <Button
                                                onClick={(e) => {
                                                    this.previousOrderHandleModal();
                                                    this.copyItem(
                                                        this.state
                                                            .selectedPreviousOrder
                                                    );
                                                    this.props.designsForItemHandler(
                                                        this.state
                                                            .selectedPreviousOrder
                                                            .item_id
                                                    );
                                                }}
                                                className="btn-sm"
                                                variant="primary"
                                            >
                                                Add Item
                                            </Button>
                                        </Modal.Footer>
                                    </Modal>
                                </div>
                                {/* React modal previous records */}
                            </div>

                            {/* Measurements details start */}
                            <div>
                                {this.props.visibleAllMeasurements && (
                                    <>
                                        {this.props.itemPart ===
                                        "Upper part" ? (
                                            <UpperMeasurement
                                                handleChange={this.handleChange}
                                                allData={this.state.allData}
                                                measurements={
                                                    this.state.measurements
                                                }
                                            />
                                        ) : (
                                            <LowerMeasurement
                                                handleChange={this.handleChange}
                                                allData={this.state.allData}
                                                measurements={
                                                    this.state.measurements
                                                }
                                            />
                                        )}
                                    </>
                                )}
                            </div>
                            {/* Measurements details end */}

                            <div className="row mb-2">
                                {/* Select design start*/}
                                <div className="col-5">
                                    <label
                                        htmlFor="design-id"
                                        className="mt-1 form-label required"
                                    >
                                        Select Design
                                    </label>
                                    <Select
                                        name="design_id"
                                        id="design-id"
                                        required
                                        getOptionLabel={(design) =>
                                            design.design_name
                                        }
                                        getOptionValue={(design) => design.id}
                                        isMulti={true}
                                        value={this.state.select.value}
                                        options={
                                            this.props.designsWithSelectedItem
                                        }
                                        onChange={(_design) => {
                                            const currentMesurement =
                                                this.state.measurements;

                                            currentMesurement.design_ids =
                                                _design.map(
                                                    (__design) => __design.id
                                                );
                                            this.setState({
                                                measurements: currentMesurement,
                                                select: {
                                                    value: _design,
                                                },
                                            });
                                            // console.log(_design);
                                            // console.log(
                                            //     currentMesurement.design_ids
                                            // );
                                        }}
                                    />
                                </div>

                                {/* Select design end */}

                                {/* fitting start  */}
                                <div className="col-3">
                                    <label
                                        htmlFor="fitting-id"
                                        className="mt-1 form-label required"
                                    >
                                        Select Fitting
                                    </label>
                                    <select
                                        name="fitting_id"
                                        className="form-control"
                                        value={
                                            this.state.measurements.fitting_id
                                        }
                                        onChange={this.handleChange}
                                        id="fitting-id"
                                        required
                                    >
                                        <option value="" disabled>
                                            --
                                        </option>
                                        {this.props.fittings.map((fitting) => (
                                            <option
                                                value={fitting.id}
                                                key={fitting.id}
                                            >
                                                {fitting.fitting_name}
                                            </option>
                                        ))}
                                    </select>
                                </div>
                                {/* fitting end  */}

                                {/* Quantity start  */}
                                <div className="col-3">
                                    <label
                                        htmlFor="quantity"
                                        className="mt-1 form-label required"
                                    >
                                        Quantity
                                    </label>
                                    <input
                                        type="number"
                                        name="quantity"
                                        onChange={this.handleChange}
                                        value={this.state.measurements.quantity}
                                        className="form-control"
                                        id="quantity"
                                        placeholder="1"
                                        required
                                    />
                                </div>
                                {/* Quantity end  */}
                            </div>

                            <div className="row mb-3">
                                <div className="col-12 mt-2 ">
                                    <button
                                        type="submit"
                                        className="btn btn-success"
                                        title="Add item"
                                        // onClick={this.handleSubmitMeasurements}
                                    >
                                        {this.state.isUpdating ? (
                                            <span className="text-white">
                                                <i className="bi bi-plus-square-dotted"></i>
                                                <span> Update item </span>
                                            </span>
                                        ) : (
                                            <span className="text-white">
                                                <i className="bi bi-plus-square"></i>
                                                <span> Add item </span>
                                            </span>
                                        )}
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                {/* Cart component */}
                <div className="row mb-3">
                    <div className="col-12">
                        <div className="mb-3 table-responsive">
                            <table className="table custom-table table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">SL</th>
                                        <th scope="col">item name</th>
                                        <th scope="col">Details</th>
                                        <th
                                            scope="col"
                                            className="print-none text-end"
                                        >
                                            Action
                                        </th>
                                    </tr>
                                </thead>

                                <tbody>
                                    {cartList.length > 0 ? (
                                        cartList
                                    ) : (
                                        <tr>
                                            <th
                                                colSpan="4"
                                                className="text-center"
                                            >
                                                Cart list is empty.
                                            </th>
                                        </tr>
                                    )}
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </>
        );
    }
}

export default MeasurementDetails;
