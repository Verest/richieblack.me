import React, { Component } from 'react';

class Input extends Component{

  handleChange = (e) => {
    this.props.onChange(e.target.value);
  }

  render(){
    // const value=this.props.value;
    return(
      <textarea
        className="input"
        value={this.props.value}
        onChange={this.handleChange}
      />
    );
  }
}


export default Input;
