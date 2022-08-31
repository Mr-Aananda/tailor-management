import React, { Component } from "react";

export default class LowerMeasurement extends Component {
    render() {
        return (
            <>
                <div className="row mb-2">
                    {/* length  Start */}
                    <div className="col-2">
                        <label
                            htmlFor="lower-length"
                            className="mt-1 form-label"
                        >
                            Length
                        </label>
                        <input
                            type="text"
                            name="lower_length"
                            value={this.props.measurements.lower_length}
                            onChange={this.props.handleChange}
                            className="form-control"
                            id="lower-length"
                            placeholder="0"
                        />
                    </div>
                    {/* length  end */}

                    {/* Muhuri  Start */}
                    <div className="col-2">
                        <label htmlFor="muhuri" className="mt-1 form-label">
                            Muhuri
                        </label>
                        <input
                            type="text"
                            name="muhuri"
                            value={this.props.measurements.muhuri}
                            onChange={this.props.handleChange}
                            className="form-control"
                            id="muhuri"
                            placeholder="0"
                        />
                    </div>
                    {/* Muhuri  end */}

                    {/* Knee  Start */}
                    <div className="col-2">
                        <label htmlFor="knee" className="mt-1 form-label">
                            Knee
                        </label>
                        <input
                            type="text"
                            name="knee"
                            value={this.props.measurements.knee}
                            onChange={this.props.handleChange}
                            className="form-control"
                            id="knee"
                            placeholder="0"
                        />
                    </div>
                    {/* Knee  end */}

                    {/* Thigh  Start */}
                    <div className="col-2">
                        <label htmlFor="thigh" className="mt-1 form-label">
                            Thigh
                        </label>
                        <input
                            type="text"
                            name="thigh"
                            value={this.props.measurements.thigh}
                            onChange={this.props.handleChange}
                            className="form-control"
                            id="thigh"
                            placeholder="0"
                        />
                    </div>
                    {/* Thigh  end */}

                    {/* Waist  Start */}
                    <div className="col-2">
                        <label htmlFor="waist" className="mt-1 form-label">
                            Waist
                        </label>
                        <input
                            type="text"
                            name="waist"
                            value={this.props.measurements.waist}
                            onChange={this.props.handleChange}
                            className="form-control"
                            id="waist"
                            placeholder="0"
                        />
                    </div>
                    {/* Waist  end */}

                    {/* Hip  Start */}
                    <div className="col-2">
                        <label htmlFor="lower-hip" className="mt-1 form-label">
                            Hip
                        </label>
                        <input
                            type="text"
                            name="lower_hip"
                            value={this.props.measurements.lower_hip}
                            onChange={this.props.handleChange}
                            className="form-control"
                            id="lower-hip"
                            placeholder="0"
                        />
                    </div>
                    {/* Hip  end */}
                </div>

                <div className="row mb-2">
                    {/* High  Start */}
                    <div className="col-2">
                        <label htmlFor="high" className="mt-1 form-label ">
                            High
                        </label>
                        <input
                            type="text"
                            name="high"
                            value={this.props.measurements.high}
                            onChange={this.props.handleChange}
                            className="form-control"
                            id="high"
                            placeholder="0"
                        />
                    </div>
                    {/* High  end */}

                    {/* Front down start */}
                    <div className="col-2">
                        <label
                            htmlFor="front-down"
                            className="mt-1 form-label "
                        >
                            Front down(FD)
                        </label>
                        <select
                            name="front_down"
                            value={this.props.measurements.front_down}
                            onChange={this.props.handleChange}
                            className="form-control"
                            id="front-down"
                        >
                            <option value="">
                                --
                            </option>
                            <option value="No FD">No FD</option>
                            <option value="1/2">1/2</option>
                            <option value="1">1</option>
                            <option value="3/4">3/4</option>
                            <option value="2">2</option>
                        </select>
                    </div>
                    {/* Front down end */}

                    {/* Back down start */}
                    <div className="col-2">
                        <label htmlFor="back-down" className="mt-1 form-label">
                            Back down(BD)
                        </label>
                        <select
                            name="back_down"
                            value={this.props.measurements.back_down}
                            onChange={this.props.handleChange}
                            className="form-control"
                            id="back-down"
                        >
                            <option value="">
                                --
                            </option>
                            <option value="No BD">No BD</option>
                            <option value="1/2">1/2</option>
                            <option value="1">1</option>
                            <option value="3/4">3/4</option>
                            <option value="2">2</option>
                        </select>
                    </div>
                    {/* Back down end */}

                    {/* Fly  Start */}
                    <div className="col-2">
                        <label htmlFor="fly" className="mt-1 form-label">
                            Fly
                        </label>
                        <input
                            type="text"
                            name="fly"
                            value={this.props.measurements.fly}
                            onChange={this.props.handleChange}
                            className="form-control"
                            id="fly"
                            placeholder="0"
                        />
                    </div>
                    {/* Fly  end */}

                    {/* Front  Start */}
                    <div className="col-2">
                        <label htmlFor="front" className="mt-1 form-label">
                            Front
                        </label>
                        <input
                            type="text"
                            name="front"
                            value={this.props.measurements.front}
                            onChange={this.props.handleChange}
                            className="form-control"
                            id="front"
                            placeholder="0"
                        />
                    </div>
                    {/* Front  end */}

                    {/* Back  Start */}
                    <div className="col-2">
                        <label htmlFor="back" className="mt-1 form-label">
                            Back
                        </label>
                        <input
                            type="text"
                            name="back"
                            value={this.props.measurements.back}
                            onChange={this.props.handleChange}
                            className="form-control"
                            id="back"
                            placeholder="0"
                        />
                    </div>
                    {/* Back  end */}
                </div>
            </>
        );
    }
}
