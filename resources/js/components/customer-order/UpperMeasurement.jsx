import React, { Component } from "react";


class UpperMeasurement extends Component {
    render() {
        return (
            <>
                <div className="row mb-2">
                    {/* length  Start */}
                    <div className="col-2">
                        <label
                            htmlFor="upper-length"
                            className="mt-1 form-label"
                        >
                            Length
                        </label>
                        <input
                            type="text"
                            name="upper_length"
                            value={this.props.measurements.upper_length}
                            onChange={this.props.handleChange}
                            className="form-control"
                            id="upper-length"
                            placeholder="0"
                        />
                    </div>
                    {/* length  end */}

                    {/* Round body  Start */}
                    <div className="col-2">
                        <label htmlFor="round-body" className="mt-1 form-label">
                            Round body
                        </label>
                        <input
                            type="text"
                            name="round_body"
                            value={this.props.measurements.round_body}
                            onChange={this.props.handleChange}
                            className="form-control"
                            id="round-body"
                            placeholder="0"
                        />
                    </div>
                    {/* Round body   end */}

                    {/* Belly  Start */}
                    <div className="col-2">
                        <label htmlFor="belly" className="mt-1 form-label">
                            Belly
                        </label>
                        <input
                            type="text"
                            name="belly"
                            value={this.props.measurements.belly}
                            onChange={this.props.handleChange}
                            className="form-control"
                            id="belly"
                            placeholder="0"
                        />
                    </div>
                    {/* Belly  end */}

                    {/* Hip  Start */}
                    <div className="col-2">
                        <label htmlFor="upper-hip" className="mt-1 form-label">
                            Hip
                        </label>
                        <input
                            type="text"
                            name="upper_hip"
                            value={this.props.measurements.upper_hip}
                            onChange={this.props.handleChange}
                            className="form-control"
                            id="upper-hip"
                            placeholder="0"
                        />
                    </div>
                    {/* Hip  end */}

                    {/* Solder  Start */}
                    <div className="col-2">
                        <label htmlFor="hip" className="mt-1 form-label">
                            Solder
                        </label>
                        <input
                            type="text"
                            name="solder"
                            value={this.props.measurements.solder}
                            onChange={this.props.handleChange}
                            className="form-control"
                            id="solder"
                            placeholder="0"
                        />
                    </div>
                    {/* Solder  end */}

                    {/* Sleeve  Start */}
                    <div className="col-2">
                        <label htmlFor="sleeve" className="mt-1 form-label">
                            Sleeve
                        </label>
                        <input
                            type="text"
                            name="sleeve"
                            value={this.props.measurements.sleeve}
                            onChange={this.props.handleChange}
                            className="form-control"
                            id="sleeve"
                            placeholder="0"
                        />
                    </div>
                    {/* Sleeve  end */}
                </div>

                <div className="row mb-2">
                    {/* Coff  Start */}
                    <div className="col-2">
                        <label htmlFor="coff" className="mt-1 form-label">
                            Coff
                        </label>
                        <input
                            type="text"
                            name="coff"
                            value={this.props.measurements.coff}
                            onChange={this.props.handleChange}
                            className="form-control"
                            id="coff"
                            placeholder="0"
                        />
                    </div>
                    {/* Coff  end */}

                    {/* Arm  Start */}
                    <div className="col-2">
                        <label htmlFor="arm" className="mt-1 form-label">
                            Arm
                        </label>
                        <input
                            type="text"
                            name="arm"
                            value={this.props.measurements.arm}
                            onChange={this.props.handleChange}
                            className="form-control"
                            id="arm"
                            placeholder="0"
                        />
                    </div>
                    {/* arm  end */}

                    {/* Mussle  Start */}
                    <div className="col-2">
                        <label htmlFor="mussle" className="mt-1 form-label">
                            Mussle
                        </label>
                        <input
                            type="text"
                            name="mussle"
                            value={this.props.measurements.mussle}
                            onChange={this.props.handleChange}
                            className="form-control"
                            id="mussle"
                            placeholder="0"
                        />
                    </div>
                    {/* Mussle  end */}

                    {/* Neck  Start */}
                    <div className="col-2">
                        <label htmlFor="neck" className="mt-1 form-label">
                            Neck
                        </label>
                        <input
                            type="text"
                            name="neck"
                            value={this.props.measurements.neck}
                            onChange={this.props.handleChange}
                            className="form-control"
                            id="neck"
                            placeholder="0"
                        />
                    </div>
                    {/* Neck  end */}

                    {/* Body front  Start */}
                    <div className="col-2">
                        <label htmlFor="body-front" className="mt-1 form-label">
                            Body front
                        </label>
                        <input
                            type="text"
                            name="body_front"
                            value={this.props.measurements.body_front}
                            onChange={this.props.handleChange}
                            className="form-control"
                            id="body-front"
                            placeholder="0"
                        />
                    </div>
                    {/* Body front end */}

                    {/* Belly front  Start */}
                    <div className="col-2">
                        <label
                            htmlFor="belly-front"
                            className="mt-1 form-label"
                        >
                            Belly front
                        </label>
                        <input
                            type="text"
                            name="belly_front"
                            value={this.props.measurements.belly_front}
                            onChange={this.props.handleChange}
                            className="form-control"
                            id="belly-front"
                            placeholder="0"
                        />
                    </div>
                    {/* Belly front end */}
                </div>

                <div className="row mb-2">
                    {/* Hip front  Start */}
                    <div className="col-2">
                        <label htmlFor="hip-front" className="mt-1 form-label">
                            Hip front
                        </label>
                        <input
                            type="text"
                            name="hip_front"
                            value={this.props.measurements.hip_front}
                            onChange={this.props.handleChange}
                            className="form-control"
                            id="hip-front"
                            placeholder="0"
                        />
                    </div>
                    {/* Hip front end */}

                    {/* Down start */}
                    <div className="col-2">
                        <label htmlFor="down" className="mt-1 form-label">
                            Down(D)
                        </label>
                        <select
                            name="down"
                            className="form-control"
                            value={this.props.measurements.down}
                            onChange={this.props.handleChange}
                            id="down"
                        >
                            <option value="">
                                --
                            </option>
                            <option value="D">D</option>
                            <option value="DD">DS</option>
                            <option value="DDD">DDS</option>
                        </select>
                    </div>
                    {/* Down end */}

                    {/* Straight start */}
                    <div className="col-2">
                        <label htmlFor="straight" className="mt-1 form-label">
                            Straight(S)
                        </label>
                        <select
                            name="straight"
                            className="form-control"
                            value={this.props.measurements.straight}
                            onChange={this.props.handleChange}
                            id="straight"
                        >
                            <option value="">
                                --
                            </option>
                            <option value="S">S</option>
                            <option value="SS">SS</option>
                            <option value="SSS">SSS</option>
                        </select>
                    </div>
                    {/* Straight end */}
                </div>
            </>
        );
    }
}

export default UpperMeasurement;
