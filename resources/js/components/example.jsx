import React, { Component } from 'react';
import ReactDOM from 'react-dom';

class Example extends React.Component {

  render() {
    return (<p>This is React component.</p>);
  }

}

// DOM element
if (document.getElementById('example')) {
  ReactDOM.render(<Example />, document.getElementById("example"));
}