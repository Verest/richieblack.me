import React, { Component } from 'react';
import Input from './input';
import Output from './output';

class Container extends Component {
  state = {
    contents: `
# Example
---
**This** is an *example*
\`\`\`javascript
    console.log(example);
\`\`\``
  };

  componentDidMount () {
      setInterval(()=>{
        const input = document.querySelector(".input")
        const output = document.querySelector(".output")
        input.style.height = output.offsetHeight + "px";
      }, 500);

  }

  handleChange = (value) => {
    this.setState({contents: value});
  }

  render() {
    return (
      <div className="mark-container">
        <p className="intro-paragraph">
          This is a React application that uses the marked JS library to convert the markdown text input into
            the correct output. I initially set up the development environment using webpack, babel, and npm with
            several dependencies installed, however I recently moved it within the Laravel framework entirely using Mix.
        </p>
        <div className="lhs">
          <h3 className="label">Input</h3>
          <Input
            value={this.state.contents}
            onChange={this.handleChange}/>
        </div>

        <div className="rhs">
          <h3 className="label">Output</h3>
          <Output value={this.state.contents}/>
        </div>
      </div>
    );
  }
}


export default Container;
