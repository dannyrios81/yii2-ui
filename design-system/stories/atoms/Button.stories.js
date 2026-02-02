import { createButton } from '../../src/components/atoms/Button';

export default {
  title: 'Atoms/Button',
  tags: ['autodocs'],
  argTypes: {
    label: {
      control: 'text',
      description: 'Button text',
      table: {
        type: { summary: 'string' },
        defaultValue: { summary: 'Button' },
      },
    },
    variant: {
      control: 'select',
      options: ['primary', 'secondary', 'success', 'danger', 'warning', 'info'],
      description: 'Button color variant',
      table: {
        type: { summary: 'string' },
        defaultValue: { summary: 'primary' },
      },
    },
    size: {
      control: 'select',
      options: ['sm', 'md', 'lg'],
      description: 'Button size',
      table: {
        type: { summary: 'string' },
        defaultValue: { summary: 'md' },
      },
    },
    outline: {
      control: 'boolean',
      description: 'Outline style',
      table: {
        type: { summary: 'boolean' },
        defaultValue: { summary: false },
      },
    },
    disabled: {
      control: 'boolean',
      description: 'Disabled state',
      table: {
        type: { summary: 'boolean' },
        defaultValue: { summary: false },
      },
    },
    icon: {
      control: 'text',
      description: 'Icon (emoji or HTML)',
    },
    iconPosition: {
      control: 'select',
      options: ['left', 'right'],
      description: 'Icon position',
    },
  },
  parameters: {
    docs: {
      description: {
        component: 'Basic button component with multiple variants and sizes. Part of the Atomic Design system.',
      },
    },
  },
};

export const Primary = {
  args: {
    label: 'Primary Button',
    variant: 'primary',
    size: 'md',
  },
};

export const Secondary = {
  args: {
    label: 'Secondary Button',
    variant: 'secondary',
  },
};

export const Success = {
  args: {
    label: 'Success Button',
    variant: 'success',
  },
};

export const Danger = {
  args: {
    label: 'Danger Button',
    variant: 'danger',
  },
};

export const WithIcon = {
  args: {
    label: 'Export Now',
    variant: 'primary',
    icon: '📥',
    iconPosition: 'left',
  },
};

export const Outline = {
  args: {
    label: 'Outline Button',
    variant: 'primary',
    outline: true,
  },
};

export const Small = {
  args: {
    label: 'Small Button',
    size: 'sm',
  },
};

export const Large = {
  args: {
    label: 'Large Button',
    size: 'lg',
  },
};

export const Disabled = {
  args: {
    label: 'Disabled Button',
    disabled: true,
  },
};

export const AllVariants = () => {
  const container = document.createElement('div');
  container.className = 'd-flex gap-2 flex-wrap';
  
  const variants = ['primary', 'secondary', 'success', 'danger', 'warning', 'info'];
  
  variants.forEach(variant => {
    container.appendChild(createButton({
      label: variant.charAt(0).toUpperCase() + variant.slice(1),
      variant,
    }));
  });
  
  return container;
};
