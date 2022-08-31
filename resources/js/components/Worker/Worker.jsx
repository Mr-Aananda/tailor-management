import React, { Component } from 'react';
import ReactDOM from "react-dom";

export default class Worker extends Component {
    constructor(props) {
        super(props);
        this.allItems = JSON.parse(this.props.items);

        // default value
        this.items = [""];

        // code
        this.state = {
            items: this.items,
            selectedItems: JSON.parse(this.props.worker) ?? [],
            cost: [],
        };

        // console.log(this.state.selectedItems);

        // console.log(this.allItems);
    }

    componentDidMount() {
        if (this.state.selectedItems.hasOwnProperty("items")) {
            this.setState({
                items: this.state.selectedItems.items,
            });
        }

    }

    // add iems
    addItem = () => {
        let items = this.state.items;

        this.setState(() => {
            // add a new pair
            items.push("");

            return {
                items: items,
            };
        });
    };

    removeItem = (index) => {
        let items = this.state.items;

        this.setState(() => {
            if (index > -1) {
                items.splice(index, 1);
            }

            return {
                items: items,
            };
        });
    };

    workerCostShowHandler = (e, i) => {
        // ajax
        axios
            .post(baseURL + "axios/getAllWorkerCost", {
                item_id: e.target.value,
            })
            .then((response) => {
                // update state
                this.allItems.map((item) => {
                    if (e.target.value == item.id) {
                        let currentItems = this.state.items;
                        currentItems[i] = item;

                        this.setState({
                            items: currentItems,
                        });
                    }
                });

                // console.log(response.data);
            })
            .catch((reason) => {
                console.log(reason);
            });
    };

    render() {
        console.log(this.state.items);
        // console.log(this.state.selectedItems.items);

        return (
            <>
                <div className="row">
                    <div className="col-2">
                        <label
                            htmlFor="item-select"
                            className="mt-1 form-label required"
                        >
                            Item select
                        </label>
                    </div>

                    <div className="col-10">
                        {/* start */}
                        {this.state.items.map((data, index) => (
                            <div className="row mb-2" key={index}>
                                <div className="col-3">
                                    <select
                                        name="item_id[]"
                                        // defaultValue={data.id}
                                        value={data.id}

                                        onChange={(e) =>
                                            this.workerCostShowHandler(e, index)
                                        }
                                        className="form-control"
                                        id="item-select"
                                        required
                                    >
                                        <option value="">--</option>
                                        {this.allItems.map((item, index) => (
                                            <option value={item.id} key={index}>
                                                {item.item_name}
                                            </option>
                                        ))}
                                    </select>
                                </div>

                                <div className="col-2">
                                    <input
                                        type="number"
                                        name="worker_cost"
                                        defaultValue={
                                            this.state.items[index].worker_cost
                                        }
                                        className="form-control"
                                        id="worker-cost"
                                        placeholder="0.00"
                                        required
                                    />
                                </div>

                                {index === 0 ? (
                                    ""
                                ) : (
                                    <div className="col-2">
                                        <button
                                            type="button"
                                            onClick={this.removeItem.bind(
                                                this,
                                                index
                                            )}
                                            className="btn btn-danger"
                                            title="remove"
                                        >
                                            <i className="bi bi-dash"></i>
                                        </button>
                                    </div>
                                )}
                            </div>
                        ))}
                        {/* end */}
                    </div>
                </div>

                <div className="mb-3 row">
                    <div className="col-2"></div>
                    <div className="col-2">
                        <button
                            type="button"
                            className="btn btn-sm btn-success"
                            onClick={this.addItem}
                        >
                            <span className="text-white">
                                <span>+ </span>
                                <span>Add more items</span>
                            </span>
                        </button>
                    </div>
                </div>
            </>
        );
    }
}

// DOM element
if (document.getElementById("multiple-add-item-and-show-worker-cost")) {
    // find element by id
    const element = document.getElementById("multiple-add-item-and-show-worker-cost");

    // create new props object with element's data-attributes
    const props = Object.assign({}, element.dataset);

    // render element with props (using spread)
    ReactDOM.render(<Worker {...props} />, element);
}
