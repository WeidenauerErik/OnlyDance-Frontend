import express from "express";
import cors from 'cors';

const app = express();
const port = 4000;

app.use(cors())

app.get('/', (req, res) => {
  res.send(steps);
});

app.listen(port, () => {
  console.log(`Server is running on port ${port}`);
});

const steps = [
  {
    howQuick: 2,
    woman: {
      leftFoot: {
        height: 0.5,
        width: 0.6,
        rotate: 180,
        footToesActive: false,
        footHeelActive: true,
      },
      rightFoot: {
        height: 0.5,
        width: 0.45,
        rotate: 180,
        footToesActive: false,
        footHeelActive: false,
      },
    },
    man: {
      leftFoot: {
        height: 0.7,
        width: 0.45,
        rotate: 0,
        footToesActive: true,
        footHeelActive: true,
      },
      rightFoot: {
        height: 0.7,
        width: 0.6,
        rotate: 0,
        footToesActive: false,
        footHeelActive: false,
      },
    },
  },
  {
    howQuick: 2,
    woman: {
      leftFoot: {
        height: 0.1,
        width: 0.6,
        rotate: 180,
        footToesActive: false,
        footHeelActive: true,
      },
      rightFoot: {
        height: 0.1,
        width: 0.45,
        rotate: 180,
        footToesActive: false,
        footHeelActive: false,
      },
    },
    man: {
      leftFoot: {
        height: 0.8,
        width: 0.45,
        rotate: 0,
        footToesActive: false,
        footHeelActive: false,
      },
      rightFoot: {
        height: 0.8,
        width: 0.8,
        rotate: 0,
        footToesActive: true,
        footHeelActive: true,
      },
    },
  },
  {
    howQuick: 2,
    woman: {
      leftFoot: {
        height: 0.1,
        width: 0.6,
        rotate: 180,
        footToesActive: false,
        footHeelActive: true,
      },
      rightFoot: {
        height: 0.1,
        width: 0.45,
        rotate: 180,
        footToesActive: false,
        footHeelActive: false,
      },
    },
    man: {
      leftFoot: {
        height: 0.5,
        width: 0.75,
        rotate: 0,
        footToesActive: true,
        footHeelActive: true,
      },
      rightFoot: {
        height: 0.8,
        width: 0.8,
        rotate: 0,
        footToesActive: false,
        footHeelActive: false,
      },
    },
  },
  {
    howQuick: 2,
    woman: {
      leftFoot: {
        height: 0.1,
        width: 0.6,
        rotate: 180,
        footToesActive: false,
        footHeelActive: true,
      },
      rightFoot: {
        height: 0.1,
        width: 0.45,
        rotate: 180,
        footToesActive: false,
        footHeelActive: false,
      },
    },
    man: {
      leftFoot: {
        height: 0.5,
        width: 0.75,
        rotate: 0,
        footToesActive: false,
        footHeelActive: false,
      },
      rightFoot: {
        height: 0.8,
        width: 0.8,
        rotate: 0,
        footToesActive: true,
        footHeelActive: true,
      },
    },
  },
  {
    howQuick: 2,
    woman: {
      leftFoot: {
        height: 0.1,
        width: 0.6,
        rotate: 180,
        footToesActive: false,
        footHeelActive: true,
      },
      rightFoot: {
        height: 0.1,
        width: 0.45,
        rotate: 180,
        footToesActive: false,
        footHeelActive: false,
      },
    },
    man: {
      leftFoot: {
        height: 0.8,
        width: 0.45,
        rotate: 0,
        footToesActive: true,
        footHeelActive: true,
      },
      rightFoot: {
        height: 0.8,
        width: 0.8,
        rotate: 0,
        footToesActive: false,
        footHeelActive: false,
      },
    },
  },
  {
    howQuick: 2,
    woman: {
      leftFoot: {
        height: 0.1,
        width: 0.6,
        rotate: 180,
        footToesActive: false,
        footHeelActive: true,
      },
      rightFoot: {
        height: 0.1,
        width: 0.45,
        rotate: 180,
        footToesActive: false,
        footHeelActive: false,
      },
    },
    man: {
      leftFoot: {
        height: 0.8,
        width: 0.45,
        rotate: 0,
        footToesActive: false,
        footHeelActive: false,
      },
      rightFoot: {
        height: 0.8,
        width: 0.6,
        rotate: 0,
        footToesActive: true,
        footHeelActive: true,
      },
    },
  },
  {
    howQuick: 2,
    woman: {
      leftFoot: {
        height: 0.1,
        width: 0.6,
        rotate: 180,
        footToesActive: false,
        footHeelActive: true,
      },
      rightFoot: {
        height: 0.1,
        width: 0.45,
        rotate: 180,
        footToesActive: false,
        footHeelActive: false,
      },
    },
    man: {
      leftFoot: {
        height: 0.8,
        width: 0.45,
        rotate: 0,
        footToesActive: false,
        footHeelActive: false,
      },
      rightFoot: {
        height: 0.8,
        width: 0.6,
        rotate: 0,
        footToesActive: true,
        footHeelActive: true,
      },
    },
  },

  {
    howQuick: 2,
    woman: {
      leftFoot: {
        height: 0.2,
        width: 0.6,
        rotate: 180,
        footToesActive: true,
        footHeelActive: false,
      },
      rightFoot: {
        height: 0.2,
        width: 0.45,
        rotate: 270,
        footToesActive: false,
        footHeelActive: false,
      },
    },
    man: {
      leftFoot: {
        height: 0.9,
        width: 0.45,
        rotate: -90,
        footToesActive: true,
        footHeelActive: false,
      },
      rightFoot: {
        height: 0.9,
        width: 0.6,
        rotate: 0,
        footToesActive: false,
        footHeelActive: false,
      },
    },
  },
  {
    howQuick: 2,
    woman: {
      leftFoot: {
        height: 0.2,
        width: 0.3,
        rotate: 180,
        footToesActive: true,
        footHeelActive: false,
      },
      rightFoot: {
        height: 0.2,
        width: 0.15,
        rotate: 270,
        footToesActive: false,
        footHeelActive: false,
      },
    },
    man: {
      leftFoot: {
        height: 0.9,
        width: 0.15,
        rotate: -90,
        footToesActive: true,
        footHeelActive: false,
      },
      rightFoot: {
        height: 0.9,
        width: 0.3,
        rotate: 0,
        footToesActive: false,
        footHeelActive: false,
      },
    },
  },
]