import React, { Component } from "react";
import ReactDOM from "react-dom";
import axios from "axios";


export default class AddSubcategories extends Component {
    constructor(props) {
        super(props);

        // code
        this.state = {
            categories: JSON.parse(this.props.categories),
            subcategories: [],
            errors: JSON.parse(this.props.errors),
            selectedExpense: JSON.parse(this.props.expense),
            selectedSubcategoryId: "",
        };

        // console.log(this.state.selectedExpense);
        // console.log(this.state.categories);
        // console.log(Object.keys(this.state.errors).length);
    }

    componentDidMount() {
        this.getSubcategory(
            this.state.selectedExpense.expense_category_id,
            "edit"
        );
    }

    getSubcategoryHandeler = (e) => {
        this.getSubcategory(e.target.value);
    };

    getSubcategory = (id) => {
        axios
            .post(baseURL + "axios/getSubcategoriesById", {
                category_id: id,
            })
            .then((response) => {
                // update state
                this.setState({
                    subcategories: response.data,
                });

                console.log(response.data);
            })
            .catch((reason) => {
                console.log(reason);
            });

        this.setState({
            selectedSubcategoryId:
                this.state.selectedExpense.expense_sub_category_id,
        });
    };

    subCategoryHandler = (e) => {
        this.setState({
            selectedSubcategoryId: e.target.value,
        });
    };

    render() {
        return (
            <>
                <div className="mb-3 row">
                    <div className="col-2">
                        <label
                            htmlFor="category"
                            className="mt-1 form-label required"
                        >
                            Category
                        </label>
                    </div>

                    <div className="col-4">
                        <select
                            type="text"
                            name="expense_category_id"
                            defaultValue={
                                this.state.selectedExpense.expense_category_id
                            }
                            onChange={this.getSubcategoryHandeler}
                            className="form-control"
                            id="category"
                            required
                        >
                            <option value="">--</option>
                            {this.state.categories.map((category, index) => (
                                <option value={category.id} key={index}>
                                    {category.category_name}
                                </option>
                            ))}
                        </select>

                        {/* error */}
                        <small className="text-danger">
                            {Object.keys(this.state.errors).length > 0
                                ? this.state.errors.category[0]
                                : ""}
                        </small>
                    </div>
                </div>

                <div className="mb-3 row">
                    <div className="col-2">
                        <label
                            htmlFor="subcategory"
                            className="mt-1 form-label required"
                        >
                            Subcategory
                        </label>
                    </div>

                    <div className="col-4">
                        <select
                            type="text"
                            name="expense_sub_category_id"
                            value={this.state.selectedSubcategoryId}
                            onChange={this.subCategoryHandler}
                            className="form-control"
                            id="subcategory"
                            required
                        >
                            <option value="">--</option>
                            {this.state.subcategories.map(
                                (subcategory, index) => (
                                    <option value={subcategory.id} key={index}>
                                        {subcategory.subcategory_name}
                                    </option>
                                )
                            )}
                        </select>

                        {/* error */}
                        <small className="text-danger">
                            {Object.keys(this.state.errors).length > 0
                                ? this.state.errors.expense_Subcategory_id[0]
                                : ""}
                        </small>
                    </div>
                </div>
            </>
        );
    }
}

// DOM element
if (document.getElementById("add-category-and-subcatigories")) {
    // find element by id
    const element = document.getElementById("add-category-and-subcatigories");

    // create new props object with element's data-attributes
    const props = Object.assign({}, element.dataset);

    // render element with props (using spread)
    ReactDOM.render(<AddSubcategories {...props} />, element);
}
