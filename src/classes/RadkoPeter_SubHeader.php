<?php

class RadkoPeter_SubHeader
{
    protected $id;
    protected $title;
    protected $link = '';
    protected $link_text = 'See all';
    protected $link_type = '';
    protected $color = '#8C8C8C';
    protected $is_fa_icon = true;
    protected $icon = 'fas fa-question';
    protected $count = -1;
    protected $count_text = 'Number of projects';

    /**
     * @param array $subheader_data 'title' and 'id' keys required
     *
     * @throws Exception
     */
    public function __construct(array $subheader_data)
    {
        if (!array_key_exists('id', $subheader_data))
        {
            throw new Exception('Sub-header data must have an element with "id" key!');
        }

        if (!array_key_exists('title', $subheader_data))
        {
            throw new Exception('Sub-header data must have an element with "title" key!');
        }

        $this->link_text = __('See all', 'radkopeter');
        $this->count_text = __('Number of projects', 'radkopeter');

        $this->set_obj_var('id', $subheader_data);
        $this->set_obj_var('title', $subheader_data);
        $this->set_obj_var('link', $subheader_data);
        $this->set_obj_var('link_text', $subheader_data);
        $this->set_obj_var('link_type', $subheader_data);
        $this->set_obj_var('color', $subheader_data);
        $this->set_obj_var('is_fa_icon', $subheader_data);
        $this->set_obj_var('icon', $subheader_data);
        $this->set_obj_var('count', $subheader_data);
        $this->set_obj_var('count_text', $subheader_data);
    }

    // ID

    public function the_id()
    {
        echo $this->get_id();
    }

    public function get_id()
    {
        return $this->id;
    }

    // Title

    public function the_title()
    {
        $out = $this->get_title();

        if ($this->is_link())
        {
            $out = '<a class="no-style hover-style" ' . $this->get_the_href() . $this->get_the_link_type() . '>' . $out . '</a>';
        }

        $out = '<h2 class="title ' . $this->get_css_class('color') . '">' . $out . '</h2>';

        echo $out;
    }

    public function get_title()
    {
        return $this->title;
    }

    // Link text

    public function the_link_text()
    {
        echo $this->get_link_text();
    }

    public function get_link_text()
    {
        return $this->link_text;
    }

    // Link

    public function the_href()
    {
        echo $this->get_the_href();
    }

    public function get_the_href()
    {
        $out = '';

        if ($this->is_link())
        {
            $out =  'href="' . $this->get_link() . '"';
        }

        return $out;
    }

    public function the_link()
    {
        echo $this->get_link();
    }

    public function get_link()
    {
        return $this->link;
    }

    // Icon

    public function the_icon(bool $container = false)
    {
        $out = '';

        if ($this->is_fa_icon())
        {
            $out .= '<i class="' . $this->get_icon() . '"></i>';
        } else
        {
            $out .= '<img alt="' . __('Icon', 'radkopeter') . '" src="' . $this->get_icon() . '">';
        }

        if ($container)
        {
            $css_classes = "icon-container " . ($this->is_fa_icon() ? $this->get_css_class('background') : '');

            if ($this->is_link())
            {
                $out = '<a class="no-style ' . $css_classes . '" ' . $this->get_the_href() . $this->get_the_link_type() . '>' . $out . '</a>';
            } else
            {
                $out = '<div class="' . $css_classes . '">' . $out . '</div>';
            }
        }

        echo $out;
    }

    public function get_icon()
    {
        return $this->icon;
    }

    // Count

    public function the_count()
    {
        echo $this->get_count();
    }

    public function get_count()
    {
        return $this->count;
    }

    // Count text

    public function the_count_text()
    {
        echo $this->get_count_text();
    }

    public function get_count_text()
    {
        return __($this->count_text, 'radkopeter');
    }

    // Link type

    public function the_link_type()
    {
        echo $this->get_the_link_type();
    }

    public function get_the_link_type()
    {
        $link_type = $this->get_link_type();
        $out = '';

        if ($link_type !== '')
        {
            $out = 'target="' . $link_type . '"';
        }

        return $out;
    }

    public function get_link_type()
    {
        return $this->link_type;
    }

    // Conditions

    public function is_fa_icon()
    {
        return $this->is_fa_icon;
    }

    public function is_link()
    {
        return $this->get_link() !== '';
    }

    public function has_count()
    {
        return $this->get_count() !== -1;
    }

    //

    public function the_color_css()
    {
        $id = $this->id;
        $color = $this->color;

        echo "
            <style>
                .__{$id}-color, .__{$id}-h-color:hover { color: {$color}; }
                .__{$id}-background, .__{$id}-h-background:hover { background-color: {$color}; }
                .__{$id}-border, .__{$id}-h-border:hover { border-color: {$color}; }
            </style>
        ";
    }

    public function the_css_class(string... $css_properties)
    {
        echo $this->get_css_class(...$css_properties);
    }

    public function get_css_class(string... $css_properties)
    {
        $id = $this->id;
        $class = '';

        foreach ($css_properties as $css_property)
        {
            $class .= "__{$id}-{$css_property} ";
        }

        return $class;
    }

    //

    private function set_obj_var(string $key, array $data)
    {
        if (array_key_exists($key, $data))
        {
            $this->$key = $data[$key];
        }
    }
}