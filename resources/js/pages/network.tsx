import { useState } from 'react';
import { GraphCanvas, darkTheme } from 'reagraph';

type NodeInfo = {
  id: string;
  label?: string;
  fill?: string;
  size?: number;
};

const nodes = [
  { id: '1', label: 'Matthijs Hulshof', fill: 'aqua', size: 5},
  { id: '2', label: 'Ids Osinga',fill: 'blue', size: 15 },
  { id: '3', label: 'Koen Brouwer', fill: '#096c6c' },
  { id: '4', label: 'Wess van Wijhe', fill: 'gold', size: 10},
  { id: '5', label: 'Marco Hendriks', fill: '#000000' },
  { id: '6', label: 'Vincent Bakker', fill: '#ff0000', size: 8 },
  { id: '7', label: 'Jasper Werkman', fill: '#00ff00' },
  { id: '8', label: 'Renzo Jutte', fill: '#0000ff', size: 1 },
];

const edges = [
  { id: 'e1-3', source: '1', target: '3' },
  { id: 'e2-3', source: '2', target: '3' },
  { id: 'e3-2', source: '3', target: '2' },
  { id: 'e2-5', source: '4', target: '2' },
  { id: 'e5-2', source: '5', target: '2' },
  { id: 'e8-2', source: '8', target: '2' },
  { id: 'e1-2', source: '1', target: '2' },
  { id: 'e7-2', source: '7', target: '2' },
];

export default function App() {
  const [selectedNode, setSelectedNode] = useState<NodeInfo | null>(null);

  return (
    <>
      <GraphCanvas
        nodes={nodes}
        edges={edges}
        cameraMode="rotate"
        theme={darkTheme}
        onNodeClick={(node) => {
          const info: NodeInfo =
            nodes.find((n) => n.id === node.id) ?? {
              id: node.id,
              label: (node as any).label,
            };
          setSelectedNode(info);
        }}
      />
      {selectedNode && (
        <div style={{position: 'fixed', top: '10px', left: '10px', background: '#333', color: '#fff', padding: '10px', borderRadius: '5px'}}>
          <p><strong>ID:</strong> {selectedNode.id}</p>
          <p><strong>Label:</strong> {selectedNode.label}</p>
          <p><strong>Fill:</strong> {selectedNode.fill}</p>
          <p><strong>Size:</strong> {selectedNode.size || 'default'}</p>
        </div>
      )}
    </>
  );
}