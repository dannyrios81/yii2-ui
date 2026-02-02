/**
 * Button Component
 * @atom
 * 
 * Basic button component with multiple variants and sizes.
 * 
 * @param {Object} props - Component props
 * @param {string} props.label - Button text
 * @param {string} [props.variant='primary'] - Button color variant
 * @param {string} [props.size='md'] - Button size
 * @param {boolean} [props.outline=false] - Outline style
 * @param {boolean} [props.disabled=false] - Disabled state
 * @param {string} [props.icon] - Icon (emoji or HTML)
 * @param {string} [props.iconPosition='left'] - Icon position
 * @param {Function} [props.onClick] - Click handler
 * @returns {HTMLElement}
 */
export const createButton = ({
  label,
  variant = 'primary',
  size = 'md',
  outline = false,
  disabled = false,
  icon = null,
  iconPosition = 'left',
  onClick = null,
}) => {
  const button = document.createElement('button');
  button.type = 'button';
  
  // Build classes
  const classes = ['btn'];
  
  if (outline) {
    classes.push(`btn-outline-${variant}`);
  } else {
    classes.push(`btn-${variant}`);
  }
  
  if (size !== 'md') {
    classes.push(`btn-${size}`);
  }
  
  button.className = classes.join(' ');
  
  // Set disabled state
  if (disabled) {
    button.disabled = true;
  }
  
  // Build content
  let content = '';
  
  if (icon && iconPosition === 'left') {
    content += `<span class="me-2">${icon}</span>`;
  }
  
  content += label;
  
  if (icon && iconPosition === 'right') {
    content += `<span class="ms-2">${icon}</span>`;
  }
  
  button.innerHTML = content;
  
  // Add click handler
  if (onClick) {
    button.addEventListener('click', onClick);
  }
  
  return button;
};

export default createButton;
