import React, { Component } from 'react'
import ReactDOM from "react-dom";

export default class AddItem extends Component {
    constructor(props) {
        super(props);
        this.allItems = JSON.parse(this.props.items);

        // default value
        this.items = [""];

        // code
        this.state = {
            items: this.items,
            selectedItems: JSON.parse(this.props.design) ?? [],
        };

        console.log(this.state.selectedItems);
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

    render() {
        return (
            <>
                <div className="row">
                    <div className="col-2">
                        <label
                            htmlFor="item-select"
                            className="mt-1 form-label required"
                        >
                            select item
                        </label>
                    </div>

                    <div className="col-4">
                        {/* start */}
                        {this.state.items.map((data, index) => (
                            <div className="row mb-2" key={index}>
                                <div className="col-10">
                                    <select
                                        name="item_id[]"
                                        // defaultValue={data.id}
                                        value={data.id}
                                        onChange={() => {

                                        }}
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
if (document.getElementById("multiple-add-item")) {
    // find element by id
    const element = document.getElementById("multiple-add-item");

    // create new props object with element's data-attributes
    const props = Object.assign({}, element.dataset);

    // render element with props (using spread)
    ReactDOM.render(<AddItem {...props} />, element);
}
